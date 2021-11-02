<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Services\CourseService;
use App\Http\Resources\CourseResource;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Resources\PaginatorResource;
use App\Http\Requests\UpdateCourseRequest;

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

        $this->courseService->store($request->all());

        return response()->stored();
    }

    public function update(UpdateCourseRequest $request, Course $course)
    {
        $this->authorize('update', $course);

        $this->courseService->update($request->all(), $course);

        return response()->stored();
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
}