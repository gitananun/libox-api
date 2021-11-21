<?php

namespace App\Notifications\Statistic;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Notifications\Messages\MailMessage;

class StatisticReported extends Notification
{
    use Queueable;

    public function __construct(private LengthAwarePaginator $statistic, private mixed $report)
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
            ->subject(__('mail.reported.subject'))
            ->greeting(__('mail.reported.greeting'))
            ->line(__('mail.reported.gratitude', ['name' => $notifiable->name]))
            ->salutation(__('quotes')[array_rand(__('quotes'))])
            ->attachData($this->report, 'report.pdf', ['mime' => 'application/pdf']);
    }
}