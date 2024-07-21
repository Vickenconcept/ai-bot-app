<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UpdateUserRoleNotification extends Notification
{
    use Queueable;

    protected $userInfo;
    /**
     * Create a new notification instance.
     */
    public function __construct($userInfo)
    {
        $this->userInfo = $userInfo;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
        ->subject('Welcome to Our Website')
        ->greeting('Hello ' . $this->userInfo['username'])
        ->line('Hurry! You Have Successfully Upgraded Your Bundle .')
        ->line('Your username: ' . $this->userInfo['username'])
        ->line('Your chosen product: ' . $this->userInfo['product'])
        ->action('Visit our website', url('/'))
        ->line('Thank you for joining us!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
