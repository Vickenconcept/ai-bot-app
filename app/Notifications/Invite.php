<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
// use Illuminate\Notifications\Notifiable;

class Invite extends Notification
{
    use Queueable;
    // use Notifiable;

    /**
     * Create a new notification instance.
     */
    protected $email, $access;

    public function __construct($email, $access)
    {
        $this->email = $email;
        $this->access = $access;
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
        $emailAddress =  $this->email;

        return (new MailMessage)
            ->from($this->email)
            ->line('The introduction to the notification.')
            ->action('Notification Action', $this->access)
            ->line('Thank you for using our application!');
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
