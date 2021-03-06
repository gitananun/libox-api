<?php

namespace App\Services;

use App\Models\User;
use App\Models\Course;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CourseService
{
    private function getQuery(): Builder | HasMany
    {
        return ($auth = User::auth()) ? $auth->courses() : Course::query();
    }

    public function index(): LengthAwarePaginator
    {
        return $this->getQuery()->paginate();
    }

    public function store(array $data): Course
    {
        $course = User::auth()->courses()->create($data);

        $course->categories()->sync($data['categories']);
        $course->badge_id = $data['badge_id'];

        $course->save();

        return $course;
    }

    public function update(array $data, Course $course): Course
    {
        $course->update($data);
        $course->badge_id = $data['badge_id'];
        $course->categories()->sync($data['categories']);

        $course->save();

        return $course;
    }

    public function delete(Course $course): void
    {
        $course->delete();
    }

    public function search(string $title): LengthAwarePaginator
    {
        return $this->getQuery()->where('title', 'LIKE', '%' . $title . '%')->paginate();
    }

    public function like(Course $course): void
    {
        $course->increment('likes');
    }

    public function dislike(Course $course): void
    {
        $course->decrement('likes');
    }

    public function indexFavorites(): LengthAwarePaginator
    {
        return User::auth()->favoriteCourses()->paginate();
    }

    public function addFavorites(int $courseId): void
    {
        User::auth()->favoriteCourses()->syncWithoutDetaching([$courseId]);
    }

    public function removeFavorites(int $courseId): void
    {
        User::auth()->favoriteCourses()->detach([$courseId]);
    }
}