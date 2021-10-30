<?php

namespace App\Http\Controllers;

use App\Services\CourseService;
use App\Http\Resources\CourseResource;

class CourseController extends Controller
{
    public function __construct(private CourseService $courseService)
    {}

    public function index()
    {
        return response()->success(CourseResource::collection($this->courseService->index()));
    }
}