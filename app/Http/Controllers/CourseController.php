<?php

namespace App\Http\Controllers;

use App\Services\CourseService;
use App\Http\Resources\CourseResource;
use App\Http\Requests\StoreCourseRequest;

class CourseController extends Controller
{
    public function __construct(private CourseService $courseService)
    {}

    public function index()
    {
        return response()->success(CourseResource::collection($this->courseService->index()));
    }

    public function store(StoreCourseRequest $request)
    {
        $this->courseService->store($request->all());

        return response()->stored();
    }
}