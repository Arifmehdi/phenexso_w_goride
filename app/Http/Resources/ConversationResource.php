<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ConversationResource extends JsonResource
{
    public function toArray($request): array
    {
        $currentUser = $request->user();
        $otherParticipant = $this->participants()
            ->where('user_id', '!=', $currentUser?->id)
            ->with('user')
            ->first();

        return [
            'id' => $this->id,
            'title' => $this->title,
            'type' => $this->type,
            'created_by' => $this->created_by,
            'last_message_at' => $this->last_message_at?->toISOString(),
            'unread_count' => $this->whenCounted('messages as unread_count', fn() => (int) ($this->unread_count ?? 0)),
            'other_user' => $otherParticipant ? [
                'id' => $otherParticipant->user->id,
                'name' => $otherParticipant->user->name,
                'email' => $otherParticipant->user->email,
                'image' => $otherParticipant->user->image,
                'user_type' => $otherParticipant->user->user_type,
            ] : null,
            'latest_message' => $this->latestMessage ? [
                'id' => $this->latestMessage->id,
                'message' => $this->latestMessage->message,
                'message_type' => $this->latestMessage->message_type,
                'sender_id' => $this->latestMessage->sender_id,
                'created_at' => $this->latestMessage->created_at->toISOString(),
            ] : null,
            'participants' => $this->whenLoaded('participants', fn() => $this->participants->map(fn($p) => [
                'id' => $p->user->id,
                'name' => $p->user->name,
                'email' => $p->user->email,
                'image' => $p->user->image,
                'is_admin' => (bool) $p->is_admin,
            ])),
            'created_at' => $this->created_at->toISOString(),
        ];
    }
}
