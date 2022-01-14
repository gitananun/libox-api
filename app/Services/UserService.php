<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class UserService
{
    public function index(?string $role): LengthAwarePaginator
    {
        return $role
            ? User::where('role', $role)->paginate()
            : User::paginate();
    }

    public function update(array $data): User
    {
        $user = User::auth();

        $user->update($data);

        return $user;
    }

    public function delete(): void
    {
        $user = User::auth();

        $user->tokens()->delete();
        $user->delete();
    }
}