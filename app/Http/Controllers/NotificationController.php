<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{

    public function index(Request $request)
    {
        $user = auth('sanctum')->user() ?? $request->user();
        $ip = $request->ip();

        // Which audience does the logged-in account belong to?
        // (user | driver | corporate | admin — each is a separate table)
        $audience = $user ? notificationAudience($user) : 'user';

        $notifications = Notification::where(function ($query) use ($user, $ip, $audience) {

            // 1. Broadcasts meant for this audience (or 'all')
            $query->where(function ($q) use ($audience) {
                $q->where('all_show', 1)
                  ->whereIn('recipient_type', ['all', $audience]);
            });

            // 2. This account's private notifications (match audience + id)
            if ($user) {
                $query->orWhere(function ($q) use ($user, $audience) {
                    $q->where('user_id', $user->id)
                      ->where('recipient_type', $audience);
                });
            }

            // 3. Guest history by IP (null user, matching IP)
            $query->orWhere(function ($q) use ($ip) {
                $q->whereNull('user_id')->where('ip_address', $ip);
            });
        })
        ->latest()
        ->paginate(20);

        return response()->json([
            'status' => true,
            'notifications' => $notifications,
        ]);
    }


    // public function index(Request $request)
    // {
    //     $user = $request->user();
    //     $ip = $request->ip();

    //     $notifications = Notification::where(function ($query) use ($user, $ip) {

    //         $query->whereNull('user_id'); // broadcast

    //         if ($user) {
    //             $query->orWhere('user_id', $user->id);
    //         }

    //         $query->orWhere('ip_address', $ip);

    //     })
    //     ->latest()
    //     ->paginate(20);

    //     return response()->json([
    //         'status' => true,
    //         'notifications' => $notifications
    //     ]);
    // }

    /**
     * GET /api/notifications/unread-count — just the number, for the bell badge.
     * Deliberately tiny: the app polls this, so it must stay cheap.
     * Audience-aware (users / drivers / corporates / admins are separate tables).
     */
    public function unreadCount(Request $request)
    {
        $user = auth('sanctum')->user() ?? $request->user();
        if (!$user) {
            return response()->json(['success' => true, 'unread' => 0]);
        }

        $count = notificationQueryFor($user)
            ->where('is_read', 0)
            ->whereNotIn('id', $this->readBroadcastIds($user))
            ->count();

        return response()->json(['success' => true, 'unread' => $count]);
    }

    /**
     * Broadcast notifications this account has already read.
     *
     * Broadcasts have `user_id = null`, so their single `is_read` flag can't
     * track per-person state — that lives in `notification_reads`.
     */
    private function readBroadcastIds($user): array
    {
        return \DB::table('notification_reads')
            ->where('user_id', $user->id)
            ->where('owner_type', notificationAudience($user))
            ->pluck('notification_id')
            ->all();
    }

    public function markAsRead(Request $request, $id)
    {
        $user = auth('sanctum')->user() ?? $request->user();
        if (!$user) {
            return response()->json(['status' => false, 'message' => 'Unauthenticated'], 401);
        }
        $audience = notificationAudience($user);

        // Only this account's personal notification (match id AND audience)
        $notification = Notification::where('id', $id)
            ->where('user_id', $user->id)
            ->where('recipient_type', $audience)
            ->first();

        if (!$notification) {
            // Not personal — it may be a broadcast this account can see.
            // Those are shared rows, so the read state is recorded per person.
            $broadcast = Notification::where('id', $id)
                ->where('all_show', 1)
                ->whereIn('recipient_type', ['all', $audience])
                ->first();

            if (!$broadcast) {
                return response()->json([
                    'status' => false,
                    'message' => 'Notification not found'
                ], 404);
            }

            \DB::table('notification_reads')->updateOrInsert(
                [
                    'notification_id' => $broadcast->id,
                    'user_id'         => $user->id,
                    'owner_type'      => $audience,
                ],
                ['read_at' => now(), 'updated_at' => now(), 'created_at' => now()]
            );

            return response()->json(['status' => true, 'message' => 'Notification marked as read']);
        }

        $notification->update(['is_read' => 1, 'read_at' => now()]);

        return response()->json([
            'status' => true,
            'message' => 'Notification marked as read'
        ]);
    }

    public function markAllRead(Request $request)
    {
        $user = auth('sanctum')->user() ?? $request->user();
        if (!$user) {
            return response()->json(['status' => false, 'message' => 'Unauthenticated'], 401);
        }

        $audience = notificationAudience($user);

        Notification::where('user_id', $user->id)
            ->where('recipient_type', $audience)
            ->where('is_read', 0)
            ->update(['is_read' => 1, 'read_at' => now()]);

        // Broadcasts are shared rows — mark them read for THIS account only,
        // otherwise "mark all read" would leave the bell badge stuck.
        $unreadBroadcasts = Notification::where('all_show', 1)
            ->whereIn('recipient_type', ['all', $audience])
            ->whereNotIn('id', $this->readBroadcastIds($user))
            ->pluck('id');

        if ($unreadBroadcasts->isNotEmpty()) {
            $now = now();
            \DB::table('notification_reads')->insertOrIgnore(
                $unreadBroadcasts->map(fn ($id) => [
                    'notification_id' => $id,
                    'user_id'         => $user->id,
                    'owner_type'      => $audience,
                    'read_at'         => $now,
                    'created_at'      => $now,
                    'updated_at'      => $now,
                ])->all()
            );
        }

        return response()->json([
            'status' => true,
            'message' => 'All notifications marked as read'
        ]);
    }

    public function ipNotifications(Request $request)
    {
        $ip = $request->ip();

        $notifications = Notification::where('ip_address', $ip)
            ->latest()
            ->paginate(20);

        return response()->json([
            'status' => true,
            'ip' => $ip,
            'notifications' => $notifications
        ]);
    }
}
