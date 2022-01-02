<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Models\Statistic;
use App\Rules\CourseScope;
use Illuminate\Support\Str;
use App\Services\CourseService;
use App\Http\Resources\CourseResource;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Resources\PaginatorResource;
use App\Http\Requests\UpdateCourseRequest;
use App\Notifications\Course\CourseCreated;
use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\RemoveFavoritesRequest;
use App\Http\Requests\UpdateFavoritesRequest;

class CourseController extends Controller
{
    public function __construct(private CourseService $courseService)
    {}

    private function storeGetDataWithImagePath(FormRequest $request): array
    {
        $image = $request->file('image');
        $name = time() . '-' . Str::slug($request->title) . '.' . $image->extension();

        return [...$request->except('image'), 'image_path' => $image->storePubliclyAs('images', $name, 'public')];
    }

    public function index()
    {
        $scope = request()->scope;

        if ($scope) {
            $rule = new CourseScope($scope);

            if (!$rule->passes('scope')) {
                return response()->message($rule->message(), 422);
            }
        }

        return response()->success(new PaginatorResource(
            CourseResource::class,
            $this->courseService->index($scope)
        ));
    }

    public function store(StoreCourseRequest $request)
    {
        $this->authorize('email_verified');

        $course = $this->courseService->store($this->storeGetDataWithImagePath($request));

        User::auth()->notify(new CourseCreated($course));

        return response()->success(new CourseResource($course));
    }

    public function update(UpdateCourseRequest $request, Course $course)
    {
        $this->authorize('update', $course);

        return response()->success(new CourseResource(
            $this->courseService->update($this->storeGetDataWithImagePath($request), $course)
        ));
    }

    public function delete(Course $course)
    {
        $this->authorize('delete', $course);

        $this->courseService->delete($course);

        return response()->deleted();
    }

    public function show(Course $course)
    {
        Course::incrementRecord($course->id, Statistic::COURSE_TYPE);

        return response()->success(new CourseResource($course));
    }

    public function search(string $title)
    {
        return response()->success(new PaginatorResource(
            CourseResource::class, $this->courseService->search($title)
        ));
    }

    public function like(Course $course)
    {
        $this->courseService->like($course);

        return response()->stored();
    }

    public function dislike(Course $course)
    {
        $this->courseService->dislike($course);

        return response()->stored();
    }

    public function indexFavorites()
    {
        return response()->success(new PaginatorResource(
            CourseResource::class,
            $this->courseService->indexFavorites()
        ));
    }

    public function addFavorites(UpdateFavoritesRequest $request)
    {
        $this->courseService->addFavorites($request->course_id);

        return response()->stored();
    }

    public function removeFavorites(RemoveFavoritesRequest $request)
    {
        $this->courseService->removeFavorites($request->course_id);

        return response()->deleted();
    }
}