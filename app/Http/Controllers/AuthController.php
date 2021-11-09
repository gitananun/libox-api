<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AuthService;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginAuthRequest;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Requests\RegisterAuthRequest;

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