<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewUserNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    protected $userInfo;

    public function __construct($userInfo)
    {
        $this->userInfo = $userInfo;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    // public function via(object $notifiable): array
    // {
    //     return ['mail'];
    // }

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
            ->line('Welcome to our website! You have successfully registered.')
            ->line('Your username: ' . $this->userInfo['username'])
            ->line('Your email: ' . $this->userInfo['email'])
            ->line('Your password: ' . $this->userInfo['password'])
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
