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
}
