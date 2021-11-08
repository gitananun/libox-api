<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Services\CategoryService;
use App\Http\Resources\CourseResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\PaginatorResource;
use App\Http\Requests\UpdateCategoryRequest;

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

    public function show(Category $category)
    {
        return response()->success(new PaginatorResource(
            CourseResource::class,
            $this->categoryService->show($category)
        ));
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $this->authorize('update', $category);

        $this->categoryService->update($request->all(), $category);

        return response()->stored();
    }

    public function delete(Category $category)
    {
        $this->authorize('delete', $category);

        $this->categoryService->delete($category);

        return response()->deleted();
    }
}