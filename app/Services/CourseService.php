<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class CourseService
{
    public function index(): Collection
    {
        return User::auth()->courses()->get();
    }
}