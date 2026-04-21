<?php
// app/Http/Controllers/ChatController.php
namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ChatController extends Controller
{
    // Get user's conversations
    public function getConversations(Request $request)
    {
        $user = Auth::user();
        
        $conversations = Conversation::whereHas('participants', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })
        ->with(['latestMessage', 'participants.user' => function ($query) use ($user) {
            $query->where('id', '!=', $user->id);
        }])
        ->withCount(['messages as unread_count' => function ($query) use ($user) {
            $query->where('sender_id', '!=', $user->id)
                ->whereDoesntHave('reads', function ($q) use ($user) {
                    $q->where('user_id', $user->id);
                });
        }])
        ->orderBy('last_message_at', 'desc')
        ->paginate($request->get('per_page', 20));

        return response()->json([
            'success' => true,
            'conversations' => $conversations
        ]);
    }

    // Create new conversation
    public function createConversation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'nullable|string|max:255',
            'type' => 'required|in:private,group',
            'participants' => 'required|array|min:1',
            'participants.*' => 'exists:users,id'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = Auth::user();

        // For private chat, check if conversation already exists
        if ($request->type === 'private') {
            $existingConversation = $this->findPrivateConversation($user->id, $request->participants[0]);
            if ($existingConversation) {
                return response()->json([
                    'success' => true,
                    'conversation' => $existingConversation->load(['participants.user', 'latestMessage']),
                    'message' => 'Conversation already exists'
                ]);
            }
        }

        DB::beginTransaction();
        try {
            $conversation = Conversation::create([
                'title' => $request->title,
                'type' => $request->type,
                'created_by' => $user->id,
                'last_message_at' => now()
            ]);

            // Add creator as participant
            $conversation->participants()->create([
                'user_id' => $user->id,
                'is_admin' => true
            ]);

            // Add other participants
            foreach ($request->participants as $participantId) {
                $conversation->participants()->create([
                    'user_id' => $participantId,
                    'is_admin' => false
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'conversation' => $conversation->load(['participants.user', 'latestMessage'])
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Failed to create conversation'], 500);
        }
    }

    // Get or create private conversation with a user
    public function getOrCreatePrivateConversation(User $otherUser)
    {
        $user = Auth::user();
        
        $conversation = $this->findPrivateConversation($user->id, $otherUser->id);
        
        if (!$conversation) {
            $conversation = Conversation::create([
                'type' => 'private',
                'created_by' => $user->id,
                'last_message_at' => now()
            ]);

            $conversation->participants()->createMany([
                ['user_id' => $user->id, 'is_admin' => true],
                ['user_id' => $otherUser->id, 'is_admin' => false]
            ]);
        }

        return response()->json([
            'success' => true,
            'conversation' => $conversation->load(['participants.user', 'messages.sender'])
        ]);
    }

    private function findPrivateConversation($userId1, $userId2)
    {
        return Conversation::where('type', 'private')
            ->whereHas('participants', function ($query) use ($userId1) {
                $query->where('user_id', $userId1);
            })
            ->whereHas('participants', function ($query) use ($userId2) {
                $query->where('user_id', $userId2);
            })
            ->with(['participants.user', 'messages' => function ($query) {
                $query->orderBy('created_at', 'desc')->limit(50);
            }])
            ->first();
    }

    // Get messages in conversation
    public function getMessages(Conversation $conversation, Request $request)
    {
        $user = Auth::user();
        
        // Check if user is participant
        if (!$conversation->participants()->where('user_id', $user->id)->exists()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $messages = $conversation->messages()
            ->with(['sender', 'reads'])
            ->orderBy('created_at', 'desc')
            ->paginate($request->get('per_page', 50));

        // Mark messages as read
        $this->markConversationMessagesAsRead($conversation, $user->id);

        return response()->json([
            'success' => true,
            'messages' => $messages,
            'conversation' => $conversation->load('participants.user')
        ]);
    }

    // Send message
    public function sendMessage(Conversation $conversation, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'message' => 'required_without:file|string',
            'message_type' => 'required|in:text,image,file,location',
            'file' => 'nullable|file|max:10240', // 10MB max
            'thumbnail' => 'nullable|image|max:2048', // 2MB max
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = Auth::user();
        
        // Check if user is participant
        if (!$conversation->participants()->where('user_id', $user->id)->exists()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        DB::beginTransaction();
        try {
            $messageData = [
                'conversation_id' => $conversation->id,
                'sender_id' => $user->id,
                'message' => $request->message,
                'message_type' => $request->message_type,
                'is_read' => false
            ];

            // Handle file upload
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $path = $file->store('chat/files', 'public');
                $messageData['file_url'] = asset('storage/' . $path);
                
                // Generate thumbnail for images
                if (in_array($file->getMimeType(), ['image/jpeg', 'image/png', 'image/gif'])) {
                    $thumbnail = $this->generateThumbnail($file);
                    if ($thumbnail) {
                        $messageData['thumbnail_url'] = $thumbnail;
                    }
                }
            }

            $message = Message::create($messageData);

            // Update conversation last message timestamp
            $conversation->update(['last_message_at' => now()]);

            // Mark sender's message as read immediately
            $message->reads()->create([
                'user_id' => $user->id,
                'read_at' => now()
            ]);

            DB::commit();

            // Broadcast event for real-time (if using WebSockets)
            // try {
            //      // Attempt to broadcast, but don't crash if it fails
            //      broadcast(new \App\Events\NewMessage($message))->toOthers();
            //  } catch (\Exception $broadcastError) {
            //      // Log the error but continue, the user still gets their message saved
            //      \Log::error("Broadcast failed: " . $broadcastError->getMessage());
            // }
            return response()->json([
                'success' => true,
                'message' => $message->load('sender')
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Failed to send message'], 500);
        }
    }

    // Mark message as read
    // public function markAsRead(Message $message)
    // {
    //     $user = Auth::user();
        
    //     // Check if user is participant in conversation
    //     if (!$message->conversation->participants()->where('user_id', $user->id)->exists()) {
    //         return response()->json(['error' => 'Unauthorized'], 403);
    //     }

    //     $message->reads()->firstOrCreate([
    //         'user_id' => $user->id
    //     ], [
    //         'read_at' => now()
    //     ]);

    //     return response()->json(['success' => true]);
    // }

    // Search users for chat
    public function searchUsers(Request $request)
    {
        $user = Auth::user();
        $search = $request->get('search', '');
        
        $users = User::where('id', '!=', $user->id)
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->select('id', 'name', 'email', 'user_type', 'image')
            ->limit(20)
            ->get();

        return response()->json(['success' => true, 'users' => $users]);
    }

    private function markConversationMessagesAsRead($conversation, $userId)
    {
        $unreadMessages = $conversation->messages()
            ->where('sender_id', '!=', $userId)
            ->whereDoesntHave('reads', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->get();

        foreach ($unreadMessages as $message) {
            $message->reads()->create([
                'user_id' => $userId,
                'read_at' => now()
            ]);
        }
    }

    private function generateThumbnail($file)
    {
        try {
            $image = \Intervention\Image\ImageManager::imagick()->read($file);
            $image->resize(200, 200, function ($constraint) {
                $constraint->aspectRatio();
            });
            
            $thumbnailPath = 'chat/thumbnails/' . uniqid() . '.jpg';
            Storage::disk('public')->put($thumbnailPath, $image->encode('jpg', 80));
            
            return asset('storage/' . $thumbnailPath);
        } catch (\Exception $e) {
            return null;
        }
    }

    public function send(Request $request)
    {

        $request->validate([
            'conversation_id' => 'required|integer',
            'message' => 'nullable|string',
            'message_type' => 'required|in:text,image,file,location',
        ]);

        $message = Message::create([
            'conversation_id' => $request->conversation_id,
            'sender_id' => auth()->id(),
            'message' => $request->message,
            'message_type' => $request->message_type,
            'file_url' => $request->file_url,
            'thumbnail_url' => $request->thumbnail_url,
        ]);

        // Dispatch the Newmessage event after creating the message
        event(new \App\Events\NewMessage($message));

        return response()->json($message, 201);
    }

    public function messages(Request $request)
    {
        $request->validate([
            'conversation_id' => 'required|integer',
            'after_id' => 'nullable|integer',
        ]);

        return Message::where('conversation_id', $request->conversation_id)
            ->where('id', '>', $request->after_id ?? 0)
            ->orderBy('id', 'asc')
            ->get();
    }

    public function markAsRead(Request $request)
    {
        Message::where('conversation_id', $request->conversation_id)
            ->where('sender_id', '!=', auth()->id())
            ->where('is_read', 0)
            ->update([
                'is_read' => 1,
                'read_at' => now(),
            ]);

        return response()->json(['status' => 'ok']);
    }


}