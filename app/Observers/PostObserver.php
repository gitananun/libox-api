<?php

namespace App\Observers;

use App\Models\Post;
use Illuminate\Support\Str;

class PostObserver
{
    /**
     * Handle the Post "create" event.
     *
     * @param  \App\Models\Post $post
     * @return void
     */
    public function creating(Post $post)
    {
        $post->slug = Str::slug($post->title);
    }

    /**
     * Handle the Post "update" event.
     *
     * @param  \App\Models\Post $post
     * @return void
     */
    public function updating(Post $post)
    {
        $post->slug = Str::slug($post->title);
    }
}