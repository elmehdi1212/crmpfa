<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Str;

class CommentEmailNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($comment)
    {
        $this->comment = $comment;
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
        return (new MailMessage)
                    ->subject('New comment on claim '.$this->comment->reclamation->title)
                    ->greeting('Hi,')
                    ->line('New comment on claim '.$this->comment->reclamation->title.':')
                    ->line('')
                    ->line(Str::limit($this->comment->comment_text, 500))
                    ->action('View full claim', route(optional($notifiable)->id ? 'admin.reclamations.show' : 'reclamations.show', $this->comment->reclamation->id))
                    ->line('Thank you')
                    ->line(config('app.name') . ' Team')
                    ->salutation(' ');
    }
}
