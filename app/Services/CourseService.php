<?php

namespace App\Services;

use App\Models\User;
use App\Models\Course;
use Illuminate\Pagination\LengthAwarePaginator;

class CourseService
{
    public function index(): LengthAwarePaginator
    {
        return User::auth()->courses()->paginate();
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