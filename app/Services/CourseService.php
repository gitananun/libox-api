<?php

namespace App\Services;

use App\Models\User;
use App\Models\Course;
use App\Enums\CourseStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CourseService
{
    private function getQuery(?string $scope = null): Builder | HasMany
    {
        return ($auth = User::auth())
            ? ($scope ? $auth->courses()->$scope() : $auth->courses())
            : ($scope ? Course::query()->$scope() : Course::query());
    }

    private function setRelations(array $data, Course $course): void
    {
        $course->categories()->sync($data['categories']);

        if (array_key_exists('instructors', $data)) {
            $course->instructors()->sync($data['instructors']);
        }

        if (array_key_exists('badge_id', $data)) {
            $course->badge_id = $data['badge_id'];
        }
    }

    public function index(?string $scope): LengthAwarePaginator
    {
        return $this->getQuery($scope)->paginate();
    }

    public function store(array $data): Course
    {
        $course = User::auth()->courses()->create($data);

        $this->setRelations($data, $course);

        $course->save();

        return $course;
    }

    public function update(array $data, Course $course): Course
    {
        $course->update($data);

        $this->setRelations($data, $course);

        $course->save();

        return $course;
    }

    public function delete(Course $course): void
    {
        $course->delete();
    }

    public function search(string $title, ?int $category): LengthAwarePaginator
    {
        return $this->getQuery()
            ->where('title', 'LIKE', '%' . $title . '%')
            ->when($category, function ($query) use ($category) {
                $query->whereHas('categories', fn($q) => $q->where('categories.id', $category));
            })
            ->paginate();
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

    public function publish(Course $course): Course
    {
        $course->published_at = now();
        $course->status = CourseStatus::PUBLISHED;
        $course->save();

        return $course;
    }
}