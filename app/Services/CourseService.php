<?php

namespace App\Services;

use App\Models\User;
use App\Models\Course;
use Illuminate\Database\Eloquent\Collection;

class CourseService
{
    public function index(): Collection
    {
        return User::auth()->courses()->get();
    }

    public function store(array $data): void
    {
        $user = User::auth();
        $user->courses()->create($data);
    }

    public function update(array $data, Course $course): void
    {
        $course->update($data);
    }

    public function delete(Course $course): void
    {
        $course->delete();
    }
}