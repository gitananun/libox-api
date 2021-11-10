<?php

namespace App\Observers;

use App\Models\User;
use App\Notifications\User\UserCreated;
use App\Notifications\User\UserDeleted;

class UserObserver
{
    /**
     * Handle the User "created" event.
     *
     * @param  \App\Models\User $user
     * @return void
     */
    public function created(User $user)
    {
        $user->notify(new UserCreated);
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param  \App\Models\User $user
     * @return void
     */
    public function deleted(User $user)
    {
        $user->notify(new UserDeleted);
    }
}