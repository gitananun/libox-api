<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AuthService;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginAuthRequest;
use Illuminate\Support\Facades\Password;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Requests\RegisterAuthRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\ForgotPasswordRequest;

class AuthController extends Controller
{
    public function __construct(private AuthService $authService)
    {}

    public function register(RegisterAuthRequest $request)
    {
        $token = $this->authService->register($request->all());

        return response()->success(['access_token' => $token, 'token_type' => 'Bearer']);
    }

    public function login(LoginAuthRequest $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->message('Invalid login credentials', 401);
        }

        $this->authService->logout();
        $token = $this->authService->login($request['email']);

        return response()->success(['access_token' => $token, 'token_type' => 'Bearer']);
    }

    public function logout()
    {
        $this->authService->logout();

        return response()->message('Logged out');
    }

    public function self(Request $request)
    {
        return response()->success(new UserResource($request->user()));
    }

    public function forgotPassword(ForgotPasswordRequest $request)
    {
        $status = $this->authService->forgotPassword($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? response()->message('Reset link sent')
            : response()->message($status, 422);
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        $status = $this->authService->resetPassword(
            $request->only('email', 'password', 'password_confirmation', 'token')
        );

        return $status == Password::PASSWORD_RESET
            ? response()->message('Password reset')
            : response()->message($status, 422);
    }

    public function redirectToProvider(string $provider)
    {
        return Socialite::driver($provider)->stateless()->redirect();
    }

    public function handleProviderCallback(string $provider)
    {
        $token = $this->authService->handleProviderCallback($provider);

        return $token
            ? response()->success(['access_token' => $token, 'token_type' => 'Bearer'])
            : response()->message('Invalid credentials', 401);
    }
}