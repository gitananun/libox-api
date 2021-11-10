<?php

namespace App\Notifications\User;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class UserDeleted extends Notification
{
    use Queueable;

    public function __construct()
    {}

    public function via(): array
    {
        return ['mail', 'database'];
    }

    /**
     * @param \App\Models\User $notifiable
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject(__('mail.user_deleted.subject'))
            ->greeting(__('mail.user_deleted.greeting'))
            ->line(__('mail.user_deleted.introduction'))
            ->action(__('mail.user_deleted.action'), url('/'))
            ->line(__('mail.user_deleted.gratitude', ['name' => $notifiable->name]))
            ->salutation(__('mail.user_deleted.salutation'));
    }

    /**
     * @param \App\Models\User $notifiable
     */
    public function toDatabase($notifiable)
    {
        return [];
    }
}