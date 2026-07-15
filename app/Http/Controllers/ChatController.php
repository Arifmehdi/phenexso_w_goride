<?php

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
    public function getConversations(Request $request)
    {
        $user = Auth::user();

        $conversations = Conversation::whereHas('participants', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })
        ->with(['latestMessage', 'participants.user'])
        ->withCount(['messages as unread_count' => function ($query) use ($user) {
            $query->where('sender_id', '!=', $user->id)
                ->whereDoesntHave('reads', function ($q) use ($user) {
                    $q->where('user_id', $user->id);
                });
        }])
        ->orderBy('last_message_at', 'desc')
        ->paginate($request->get('per_page', 20));

        // Append other_user so Flutter can identify the other party
        $conversations->getCollection()->transform(function ($conv) use ($user) {
            $otherParticipant = $conv->participants->firstWhere('user_id', '!=', $user->id);
            $conv->other_user = $otherParticipant?->user;
            return $conv;
        });

        return response()->json([
            'success' => true,
            'conversations' => $conversations
        ]);
    }

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

            $conversation->participants()->create([
                'user_id' => $user->id,
                'is_admin' => true
            ]);

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

    public function getConversation(Conversation $conversation)
    {
        $user = Auth::user();

        if (!$conversation->participants()->where('user_id', $user->id)->exists()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $conversation->load(['participants.user', 'latestMessage']);
        $otherParticipant = $conversation->participants->firstWhere('user_id', '!=', $user->id);
        $conversation->other_user = $otherParticipant?->user;

        return response()->json([
            'success' => true,
            'conversation' => $conversation
        ]);
    }

    public function addParticipant(Request $request, Conversation $conversation)
    {
        $user = Auth::user();

        if (!$conversation->participants()->where('user_id', $user->id)->where('is_admin', true)->exists()) {
            return response()->json(['error' => 'Only admins can add participants'], 403);
        }

        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        if ($conversation->participants()->where('user_id', $request->user_id)->exists()) {
            return response()->json(['error' => 'User is already a participant'], 422);
        }

        $conversation->participants()->create([
            'user_id' => $request->user_id,
            'is_admin' => false
        ]);

        return response()->json([
            'success' => true,
            'conversation' => $conversation->load('participants.user')
        ]);
    }

    public function removeParticipant(Conversation $conversation, User $user)
    {
        $currentUser = Auth::user();

        if (!$conversation->participants()->where('user_id', $currentUser->id)->where('is_admin', true)->exists()) {
            return response()->json(['error' => 'Only admins can remove participants'], 403);
        }

        if ($conversation->created_by === $user->id) {
            return response()->json(['error' => 'Cannot remove the conversation creator'], 422);
        }

        $conversation->participants()->where('user_id', $user->id)->delete();

        return response()->json(['success' => true]);
    }

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

        $conversation->load(['participants.user', 'latestMessage']);
        $otherParticipant = $conversation->participants->firstWhere('user_id', '!=', $user->id);
        $conversation->other_user = $otherParticipant?->user;

        return response()->json([
            'success' => true,
            'conversation' => $conversation
        ]);
    }

    public function getMessages(Conversation $conversation, Request $request)
    {
        $user = Auth::user();

        if (!$conversation->participants()->where('user_id', $user->id)->exists()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $messages = $conversation->messages()
            ->with(['sender', 'reads'])
            ->orderBy('created_at', 'desc')
            ->paginate($request->get('per_page', 50));

        $this->markConversationMessagesAsRead($conversation, $user->id);

        return response()->json([
            'success' => true,
            'messages' => $messages,
            'conversation' => $conversation->load('participants.user')
        ]);
    }

    public function sendMessage(Conversation $conversation, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'message' => 'required_without:file|nullable|string',
            'message_type' => 'required|in:text,image,file,location',
            'file' => 'nullable|file|max:10240',
            'thumbnail' => 'nullable|image|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = Auth::user();

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

            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $path = $file->store('chat/files', 'public');
                $messageData['file_url'] = asset('storage/' . $path);

                if (in_array($file->getMimeType(), ['image/jpeg', 'image/png', 'image/gif', 'image/webp'])) {
                    $thumbnail = $this->generateThumbnail($file);
                    if ($thumbnail) {
                        $messageData['thumbnail_url'] = $thumbnail;
                    }
                }
            }

            $message = Message::create($messageData);

            $conversation->update(['last_message_at' => now()]);

            $message->reads()->create([
                'user_id' => $user->id,
                'read_at' => now()
            ]);

            DB::commit();

            try {
                broadcast(new \App\Events\NewMessage($message))->toOthers();
            } catch (\Exception $broadcastError) {
                \Log::error("Broadcast failed: " . $broadcastError->getMessage());
            }

            return response()->json([
                'success' => true,
                'message' => $message->load('sender')
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Failed to send message: ' . $e->getMessage()], 500);
        }
    }

    public function deleteMessage(Message $message)
    {
        $user = Auth::user();

        if ($message->sender_id !== $user->id) {
            return response()->json(['error' => 'You can only delete your own messages'], 403);
        }

        $message->delete();

        return response()->json(['success' => true]);
    }

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

    public function send(Request $request)
    {
        $request->validate([
            'conversation_id' => 'required|integer|exists:conversations,id',
            'message' => 'nullable|string',
            'message_type' => 'required|in:text,image,file,location',
        ]);

        $user = Auth::user();

        $conversation = Conversation::findOrFail($request->conversation_id);

        if (!$conversation->participants()->where('user_id', $user->id)->exists()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $messageData = [
            'conversation_id' => $request->conversation_id,
            'sender_id' => $user->id,
            'message' => $request->message,
            'message_type' => $request->message_type,
            'is_read' => false
        ];

        if ($request->filled('file_url')) {
            $messageData['file_url'] = $request->file_url;
        }
        if ($request->filled('thumbnail_url')) {
            $messageData['thumbnail_url'] = $request->thumbnail_url;
        }

        $message = Message::create($messageData);

        $conversation->update(['last_message_at' => now()]);

        $message->reads()->create([
            'user_id' => $user->id,
            'read_at' => now()
        ]);

        try {
            broadcast(new \App\Events\NewMessage($message))->toOthers();
        } catch (\Exception $broadcastError) {
            \Log::error("Broadcast failed: " . $broadcastError->getMessage());
        }

        return response()->json([
            'success' => true,
            'message' => $message->load('sender')
        ], 201);
    }

    public function messages(Request $request)
    {
        $request->validate([
            'conversation_id' => 'required|integer|exists:conversations,id',
            'after_id' => 'nullable|integer',
        ]);

        $user = Auth::user();

        $conversation = Conversation::findOrFail($request->conversation_id);

        if (!$conversation->participants()->where('user_id', $user->id)->exists()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $query = Message::where('conversation_id', $request->conversation_id)
            ->with('sender');

        if ($request->filled('after_id')) {
            $query->where('id', '>', $request->after_id);
        }

        return response()->json([
            'success' => true,
            'messages' => $query->orderBy('id', 'asc')->get()
        ]);
    }

    public function markAsRead(Request $request)
    {
        $request->validate([
            'conversation_id' => 'required|integer|exists:conversations,id',
        ]);

        $user = Auth::user();

        Message::where('conversation_id', $request->conversation_id)
            ->where('sender_id', '!=', $user->id)
            ->where('is_read', 0)
            ->update([
                'is_read' => 1,
                'read_at' => now(),
            ]);

        return response()->json(['success' => true, 'status' => 'ok']);
    }

    public function webIndex(Request $request)
    {
        return view('goride.chat.index');
    }

    public function webShow(Conversation $conversation, Request $request)
    {
        $user = Auth::user();
        if (!$conversation->participants()->where('user_id', $user->id)->exists()) {
            abort(403);
        }
        return view('goride.chat.show', compact('conversation'));
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
            ->with(['participants.user', 'latestMessage'])
            ->first();
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
            \Illuminate\Support\Facades\Storage::disk('public')->put($thumbnailPath, $image->encode('jpg', 80));

            return asset('storage/' . $thumbnailPath);
        } catch (\Exception $e) {
            return null;
        }
    }
}
