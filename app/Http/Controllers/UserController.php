<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use App\Http\Resources\UserResource;
use App\Http\Requests\IndexUserRequest;
use App\Http\Resources\PaginatorResource;

class UserController extends Controller
{
    public function __construct(private UserService $userService)
    {}

    public function index(IndexUserRequest $request)
    {
        $this->authorize('is_admin');

        return response()->success(new PaginatorResource(
            UserResource::class,
            $this->userService->index($request->role),
        ));
    }

    public function delete()
    {
        $this->userService->delete();

        return response()->deleted();
    }
}