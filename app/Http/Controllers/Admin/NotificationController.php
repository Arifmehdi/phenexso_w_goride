<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Services\NotificationService;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        if (function_exists('menuSubmenu')) menuSubmenu('notifications', 'sendNotification');

        $query = Notification::query();

        // Filter: broadcasts only (default) or every notification
        $scope = $request->get('scope', 'broadcast');
        if ($scope === 'broadcast') {
            $query->where('all_show', 1);
        }

        // Filter by audience
        if ($request->filled('audience')) {
            $query->where('recipient_type', $request->audience);
        }

        // Filter by type/category
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $notifications = $query->latest()->paginate(15)->withQueryString();

        // Quick stats for the dashboard cards
        $stats = [
            'total'      => Notification::count(),
            'broadcasts' => Notification::where('all_show', 1)->count(),
            'unread'     => Notification::where('is_read', 0)->count(),
            'today'      => Notification::whereDate('created_at', today())->count(),
        ];

        return view('admin.notifications.index', compact('notifications', 'stats', 'scope'));
    }

    public function send(Request $request, NotificationService $service)
    {
        $request->validate([
            'target'  => 'required|in:all_users,all_drivers,all_corporates,all_admins,everyone',
            'title'   => 'required|string|max:255',
            'message' => 'nullable|string|max:1000',
        ]);

        $service->send(
            $request->target,
            $request->title,
            $request->message,
            'announcement'
        );

        $label = [
            'all_users'      => 'all customers',
            'all_drivers'    => 'all riders',
            'all_corporates' => 'all corporates',
            'all_admins'     => 'all admins',
            'everyone'       => 'everyone',
        ][$request->target] ?? 'recipients';

        return redirect()->route('admin.notifications.index')
            ->with('success', "Notification sent to {$label}.");
    }

    public function destroy(Notification $notification)
    {
        $notification->delete();
        return redirect()->route('admin.notifications.index')->with('success', 'Notification deleted.');
    }
}
