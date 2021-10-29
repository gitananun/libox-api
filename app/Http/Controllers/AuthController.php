<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginAuthRequest;
use App\Http\Requests\RegisterAuthRequest;

class AuthController extends Controller
{
    public function register(RegisterAuthRequest $request)
    {
        $data = $request->all();

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'lastname' => $data['lastname'],
            'password' => Hash::make($data['password']),
            'date_of_birth' => $data['date_of_birth'] ?? null,
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->success(['access_token' => $token, 'token_type' => 'Bearer']);
    }

    public function login(LoginAuthRequest $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->message('Invalid login credentials', 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->success(['access_token' => $token, 'token_type' => 'Bearer']);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return response()->message('Logged out');
    }

    public function self(Request $request)
    {
        return response()->success($request->user());
    }

}