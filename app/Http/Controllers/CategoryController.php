<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Statistic;
use App\Services\CategoryService;
use App\Http\Resources\CourseResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\PaginatorResource;
use App\Http\Requests\StoreCategoryRequest;
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
        Category::incrementRecord($category->id, Statistic::CATEGORY_TYPE);

        return response()->success(new PaginatorResource(
            CourseResource::class,
            $this->categoryService->show($category)
        ));
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $this->authorize('is_admin');

        $this->categoryService->update($request->all(), $category);

        return response()->stored();
    }

    public function delete(Category $category)
    {
        $this->authorize('is_admin');

        $this->categoryService->delete($category);

        return response()->deleted();
    }

    public function store(StoreCategoryRequest $request)
    {
        $this->authorize('is_admin');

        $this->categoryService->store($request->all());

        return response()->stored();
    }
}