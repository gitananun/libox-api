<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class UserService
{
    public function delete(): void
    {
        $user = User::auth();

        $user->tokens()->delete();
        $user->delete();
    }

    public function index(?string $role): LengthAwarePaginator
    {
        return $role
            ? User::where('role', $role)->paginate()
            : User::paginate();
    }
}