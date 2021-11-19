<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Services\CourseService;
use App\Http\Resources\CourseResource;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Resources\PaginatorResource;
use App\Http\Requests\UpdateCourseRequest;
use App\Http\Requests\RemoveFavoritesRequest;
use App\Http\Requests\UpdateFavoritesRequest;

class CourseController extends Controller
{
    public function __construct(private CourseService $courseService)
    {}

    public function index()
    {
        return response()->success(new PaginatorResource(
            CourseResource::class,
            $this->courseService->index()
        ));
    }

    public function store(StoreCourseRequest $request)
    {
        $this->authorize('email_verified');

        return response()->success(new CourseResource($this->courseService->store($request->all())));
    }

    public function update(UpdateCourseRequest $request, Course $course)
    {
        $this->authorize('update', $course);

        return response()->success(new CourseResource($this->courseService->update($request->all(), $course)));
    }

    public function delete(Course $course)
    {
        $this->authorize('delete', $course);

        $this->courseService->delete($course);

        return response()->deleted();
    }

    public function show(Course $course)
    {
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