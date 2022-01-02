<?php

namespace App\Notifications\User;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use App\Notifications\AbstractDatabaseNotification;

class UserDeleted extends AbstractDatabaseNotification
{
    use Queueable;

    public function getTitle(): string
    {
        return __('mail.user_deleted.title');
    }

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
            ->salutation(__('quotes')[array_rand(__('quotes'))]);
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => $this->getTitle(),
        ];
    }
}