<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ApiResetPasswordNotification extends Notification
{
    use Queueable;

    public $token;
    public static $createUrlCallback;

    /**
     * Base URL for the reset link, captured from the incoming request by the
     * controller so the same codebase works on any domain without env changes.
     */
    public static $resetBaseUrl;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        if (static::$createUrlCallback) {
            $frontendResetUrl = call_user_func(static::$createUrlCallback, $notifiable, $this->token);
        } else {
            // Base URL priority: domain the request came in on (any domain works),
            // then an explicit FRONTEND_URL override, then the current app root.
            $baseUrl = static::$resetBaseUrl ?: env('FRONTEND_URL') ?: url('/');

            $frontendResetUrl = rtrim($baseUrl, '/') . '/reset-password?' . http_build_query([
                'token' => $this->token,
                'email' => $notifiable->getEmailForPasswordReset(),
                'guard' => 'web',
            ]);
        }

        return (new MailMessage)
                    ->subject('Reset Password Notification - GoRide')
                    ->line('You are receiving this email because we received a password reset request for your account.')
                    ->action('Reset Password', $frontendResetUrl)
                    ->line('This password reset link will expire in ' . config('auth.passwords.users.expire') . ' minutes.')
                    ->line('If you did not request a password reset, no further action is required.')
                    ->line('You can also use the following token and email in the GoRide app to reset your password:')
                    ->line('Token: ' . $this->token)
                    ->line('Email: ' . $notifiable->getEmailForPasswordReset());
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
