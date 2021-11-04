<?php

namespace App\Observers;

use App\Models\Category;
use Illuminate\Support\Str;

class CategoryObserver
{
    /**
     * Handle the Category "create" event.
     *
     * @param  \App\Models\Category $category
     * @return void
     */
    public function creating(Category $category)
    {
        $category->slug = Str::slug($category->name);
    }

    /**
     * Handle the Course "update" event.
     *
     * @param  \App\Models\Category $category
     * @return void
     */
    public function updating(Category $category)
    {
        $category->slug = Str::slug($category->name);
    }
}
