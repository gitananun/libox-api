<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function register(array $data): string
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'lastname' => $data['lastname'],
            'password' => Hash::make($data['password']),
            'date_of_birth' => $data['date_of_birth'] ?? null,
        ]);

        return $user->createToken('auth_token')->plainTextToken;
    }

    public function login(string $email): string
    {
        $user = User::where('email', $email)->firstOrFail();

        return $user->createToken('auth_token')->plainTextToken;
    }

    public function logout(): void
    {
        User::auth()->tokens()->delete();
    }
}