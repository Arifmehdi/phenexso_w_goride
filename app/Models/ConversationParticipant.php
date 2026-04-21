<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConversationParticipant extends Model
{
    use SoftDeletes;

    protected $table = 'conversation_participants';

    protected $primaryKey = 'id'; // ✅ VERY IMPORTANT

    protected $fillable = [
        'conversation_id',
        'user_id',
        'joined_at',
        'is_admin'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function conversation()
    {
        return $this->belongsTo(Conversation::class, 'conversation_id');
    }
}
