<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Pagination\LengthAwarePaginator;

class CategoryService
{
    public function index(): LengthAwarePaginator
    {
        return Category::paginate();
    }

    public function show(Category $category): LengthAwarePaginator
    {
        return $category->courses()->paginate();
    }

    public function update(array $data, Category $category): Category
    {
        $category->update($data);

        return $category;
    }

    public function delete(Category $category): void
    {
        $category->delete();
    }

    public function store(array $data): Category
    {
        return Category::create($data);
    }
}