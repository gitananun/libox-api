<?php

namespace App\Notifications\Statistic;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Notifications\Messages\MailMessage;

class StatisticReport extends Notification
{
    use Queueable;

    public function __construct(private LengthAwarePaginator $statistic)
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
            ->subject('Statistic Report Requested');
    }
}