<?php

namespace App\Services;

use App\Models\Admin;
use App\Models\Corporate;
use App\Models\Driver;
use App\Models\Notification;
use App\Models\User;

/**
 * Central notification service for the 4-table identity model:
 *   users (customers/passengers/owners), drivers, corporates, admins.
 *
 * Every send stores an in-app notification AND pushes FCM (where a token exists).
 * Call from anywhere via the notify() helper:
 *   notify()->toDriver($driver, 'Approved', 'You can now go online');
 *   notify()->toAllUsers('Eid Offer', '20% off all rides!');
 *   notify()->toEveryone('Maintenance', 'App down at 2 AM');
 */
class NotificationService
{
    protected FcmService $fcm;

    public function __construct()
    {
        $this->fcm = new FcmService();
    }

    // ── Single recipient (any of the 4 models) ──────────────────────────

    /** Generic: notify any single model (User|Driver|Corporate|Admin). */
    public function toRecipient($model, string $title, ?string $message = null, string $type = 'general', array $data = []): Notification
    {
        $audience = notificationAudience($model);

        $notif = Notification::create([
            'user_id'        => $model->id,
            'recipient_type' => $audience,
            'title'          => $title,
            'message'        => $message,
            'type'           => $type,
            'data'           => $data ?: null,
            'all_show'       => false,
        ]);

        // Only User & Driver have fcm_token (mobile app); corporates/admins are web-only.
        if (!empty($model->fcm_token)) {
            $this->fcm->send($model->fcm_token, $title, (string) $message, array_merge($data, ['type' => $type]));
        }

        return $notif;
    }

    public function toUser(User $user, string $title, ?string $message = null, string $type = 'general', array $data = []): Notification
    {
        return $this->toRecipient($user, $title, $message, $type, $data);
    }

    public function toDriver(Driver $driver, string $title, ?string $message = null, string $type = 'general', array $data = []): Notification
    {
        return $this->toRecipient($driver, $title, $message, $type, $data);
    }

    public function toCorporate(Corporate $corporate, string $title, ?string $message = null, string $type = 'general', array $data = []): Notification
    {
        return $this->toRecipient($corporate, $title, $message, $type, $data);
    }

    public function toAdmin(Admin $admin, string $title, ?string $message = null, string $type = 'general', array $data = []): Notification
    {
        return $this->toRecipient($admin, $title, $message, $type, $data);
    }

    // ── Broadcast to a whole audience ───────────────────────────────────

    public function toAllUsers(string $title, ?string $message = null, string $type = 'announcement', array $data = []): Notification
    {
        return $this->broadcast('user', User::class, $title, $message, $type, $data);
    }

    public function toAllDrivers(string $title, ?string $message = null, string $type = 'announcement', array $data = []): Notification
    {
        return $this->broadcast('driver', Driver::class, $title, $message, $type, $data);
    }

    public function toAllCorporates(string $title, ?string $message = null, string $type = 'announcement', array $data = []): Notification
    {
        // Corporates have no fcm_token — in-app/web only (null model class skips push).
        return $this->broadcast('corporate', null, $title, $message, $type, $data);
    }

    public function toAllAdmins(string $title, ?string $message = null, string $type = 'announcement', array $data = []): Notification
    {
        return $this->broadcast('admin', null, $title, $message, $type, $data);
    }

    /** Broadcast to EVERYONE across all audiences. */
    public function toEveryone(string $title, ?string $message = null, string $type = 'announcement', array $data = []): Notification
    {
        $notif = Notification::create([
            'user_id'        => null,
            'recipient_type' => 'all',
            'title'          => $title,
            'message'        => $message,
            'type'           => $type,
            'data'           => $data ?: null,
            'all_show'       => true,
        ]);

        $tokens = array_merge(
            User::whereNotNull('fcm_token')->pluck('fcm_token')->all(),
            Driver::whereNotNull('fcm_token')->pluck('fcm_token')->all()
        );
        $this->pushToTokens($tokens, $title, $message, $type, $data);

        return $notif;
    }

    /** Broadcast to Users with a specific role (e.g. 'owner', 'solo'). */
    public function toRole(string $role, string $title, ?string $message = null, string $type = 'announcement', array $data = []): Notification
    {
        $notif = Notification::create([
            'user_id'        => null,
            'recipient_type' => 'user',
            'title'          => $title,
            'message'        => $message,
            'type'           => $type,
            'data'           => $data ?: null,
            'all_show'       => true,
        ]);

        $this->pushToTokens(
            User::where('role', $role)->whereNotNull('fcm_token')->pluck('fcm_token')->all(),
            $title, $message, $type, $data
        );

        return $notif;
    }

    /** Generic dispatch used by the admin broadcast form. */
    public function send(string $target, string $title, ?string $message = null, string $type = 'announcement', array $data = []): Notification
    {
        return match ($target) {
            'all_users'      => $this->toAllUsers($title, $message, $type, $data),
            'all_drivers'    => $this->toAllDrivers($title, $message, $type, $data),
            'all_corporates' => $this->toAllCorporates($title, $message, $type, $data),
            'all_admins'     => $this->toAllAdmins($title, $message, $type, $data),
            'everyone'       => $this->toEveryone($title, $message, $type, $data),
            default          => $this->toEveryone($title, $message, $type, $data),
        };
    }

    // ── Internals ───────────────────────────────────────────────────────

    /**
     * Create one broadcast record for an audience and push FCM to that
     * audience's tokens. $modelClass null = no push (web-only audience).
     */
    private function broadcast(string $audience, ?string $modelClass, string $title, ?string $message, string $type, array $data): Notification
    {
        $notif = Notification::create([
            'user_id'        => null,
            'recipient_type' => $audience,
            'title'          => $title,
            'message'        => $message,
            'type'           => $type,
            'data'           => $data ?: null,
            'all_show'       => true,
        ]);

        if ($modelClass !== null) {
            $tokens = $modelClass::whereNotNull('fcm_token')->pluck('fcm_token')->all();
            $this->pushToTokens($tokens, $title, $message, $type, $data);
        }

        return $notif;
    }

    private function pushToTokens(array $tokens, string $title, ?string $message, string $type, array $data): void
    {
        $payload = array_merge($data, ['type' => $type]);
        foreach (array_filter(array_unique($tokens)) as $token) {
            $this->fcm->send($token, $title, (string) $message, $payload);
        }
    }
}
