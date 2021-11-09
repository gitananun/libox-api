<?php

namespace App\Observers;

use App\Models\User;
use App\Notifications\AccountRegistered;

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
        $user->notify(new AccountRegistered);
    }
}