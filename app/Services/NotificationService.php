<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class NotificationService
{
    public function index(): LengthAwarePaginator
    {
        $user = User::auth();

        return $user->notifications()->paginate();
    }

    public function read(DatabaseNotification $notification): void
    {
        $notification->markAsRead();
    }

    public function readAll(): void
    {
        $user = User::auth();

        $user->unreadNotifications->markAsRead();
    }
}