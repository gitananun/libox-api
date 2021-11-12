<?php

namespace App\Notifications\User;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class UserCreated extends Notification
{
    use Queueable;

    public function __construct()
    {}

    public function via(): array
    {
        return ['mail'];
    }

    /**
     * @param \App\Models\User $notifiable
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject(__('mail.user_created.subject'))
            ->greeting(__('mail.user_created.greeting'))
            ->line(__('mail.user_created.introduction'))
            ->action(__('mail.user_created.action'), url('/'))
            ->line(__('mail.user_created.gratitude', ['name' => $notifiable->name]))
            ->salutation(__('quotes')[array_rand(__('quotes'))]);
    }
}