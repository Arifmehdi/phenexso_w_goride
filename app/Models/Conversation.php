<?php
// app/Models/Conversation.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Conversation extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'title',
        'type',
        'created_by',
        'last_message_at'
    ];

    protected $casts = [
        'last_message_at' => 'datetime'
    ];

    public function participants()
    {
        return $this->hasMany(ConversationParticipant::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'conversation_participants')
            ->using(ConversationParticipant::class) // Use the pivot model
            ->withPivot(['id', 'is_admin', 'joined_at', 'created_at', 'updated_at', 'deleted_at'])
            ->withTimestamps();
    }


    public function messages()
    {
        return $this->hasMany(Message::class, 'conversation_id')
            ->orderBy('created_at', 'asc');
    }

    public function latestMessage()
    {
        return $this->hasOne(Message::class, 'conversation_id')->latest();
    }

}