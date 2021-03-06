<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Laravel\Socialite\Facades\Socialite;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Auth\Events\PasswordReset;

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

    public function forgotPassword(array $email): string
    {
        return Password::sendResetLink($email);
    }

    public function resetPassword(array $data): string
    {
        return Password::reset(
            $data,
            function (User $user, string $password) {
                $user->forceFill(['password' => Hash::make($password)])->save();
                $user->setRememberToken(Str::random(60));

                event(new PasswordReset($user));
            }
        );
    }

    public function handleProviderCallback(string $provider): ?string
    {
        try {
            $user = Socialite::driver($provider)->stateless()->user();
        } catch (ClientException $_) {
            return null;
        }

        $fullName = $user->getName();
        $userCreated = User::firstOrCreate(
            ['email' => $user->getEmail()],
            ['email_verified_at' => now(), 'name' => explode(' ', $fullName)[0], 'lastname' => explode(' ', $fullName)[1]]
        );

        $userCreated->providers()->updateOrCreate(
            ['provider' => $provider, 'provider_id' => $user->getId()],
            ['avatar' => $user->getAvatar()]
        );

        return $userCreated->createToken('auth_token')->plainTextToken;
    }
}