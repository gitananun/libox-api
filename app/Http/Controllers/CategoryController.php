<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\PaginatorResource;

class CategoryController extends Controller
{
    public function __construct(private CategoryService $categoryService)
    {}

    public function index()
    {
        return response()->success(new PaginatorResource(
            CategoryResource::class,
            $this->categoryService->index()
        ));
    }
}