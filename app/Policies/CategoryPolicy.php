<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;

    public function update(User $user): bool
    {
        return User::auth()->id === $user->id;
    }

    public function delete(User $user): bool
    {
        return User::auth()->id === $user->id;
    }
}