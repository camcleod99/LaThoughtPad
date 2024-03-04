<?php

namespace App\Notifications;

use App\Models\Thought;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Str;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewThought extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public Thought $thought)
    {
        //
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
          -> line("New Thought from {$this->thought->user->name}")
          -> greeting("New Thought from {$this->thought->user->name}")
          -> line(Str::limit($this->thought->message, 50))
          -> action('Go to ThoughtPad', url('/'))
          -> line('Thank you for using ThoughtPad!');
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
