<?php

namespace App\Http\Controllers\Goride;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $user = currentUser();
        abort_unless($user, 403);

        $notifications = notificationQueryFor($user)->latest()->paginate(20);

        return view('goride.notifications', compact('notifications'));
    }

    public function markRead($id)
    {
        $user = currentUser();
        abort_unless($user, 403);
        $audience = ($user instanceof \App\Models\Driver) ? 'driver' : 'user';

        // Only personal notifications can be marked read (broadcasts are shared)
        Notification::where('id', $id)
            ->where('user_id', $user->id)
            ->where('recipient_type', $audience)
            ->update(['is_read' => 1, 'read_at' => now()]);

        return back();
    }

    public function markAllRead()
    {
        $user = currentUser();
        abort_unless($user, 403);
        $audience = ($user instanceof \App\Models\Driver) ? 'driver' : 'user';

        Notification::where('user_id', $user->id)
            ->where('recipient_type', $audience)
            ->where('is_read', 0)
            ->update(['is_read' => 1, 'read_at' => now()]);

        return back()->with('success', 'All notifications marked as read.');
    }
}
