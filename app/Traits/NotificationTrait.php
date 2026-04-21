<?php
namespace App\Traits;

use App\Models\Notification;

trait NotificationTrait
{

    public function createNotification($title, $message = null, $userId = null, $ip = null, $type = null)
    {
        return Notification::create([
            'user_id' => $userId,
            'title' => $title,
            'message' => $message,
            'ip_address' => $ip,
            'type' => $type
        ]);
    }

}

?>