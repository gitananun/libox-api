<?php
namespace App\Notifications;

use Illuminate\Notifications\Notification;

abstract class AbstractDatabaseNotification extends Notification
{
    abstract public function getTitle(): string;

    /**
     * @param \App\Models\User $notifiable
     */
    abstract public function toDatabase($notifiable);
}