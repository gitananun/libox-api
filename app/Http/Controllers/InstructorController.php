<?php

namespace App\Http\Controllers;

use App\Services\InstructorService;
use App\Http\Resources\PaginatorResource;
use App\Http\Resources\InstructorResource;

class InstructorController extends Controller
{
    public function __construct(private InstructorService $instructorService)
    {}

    public function index()
    {
        return response()->success(new PaginatorResource(
            InstructorResource::class,
            $this->instructorService->index(),
        ));
    }

    public function search(string $name)
    {
        return response()->success(new PaginatorResource(
            InstructorResource::class, $this->instructorService->search($name)
        ));
    }
}