<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Pagination\LengthAwarePaginator;

class PostService
{
    public function index(): LengthAwarePaginator
    {
        return Post::paginate();
    }

    public function store(array $data): Post
    {
        return Post::updateOrCreate($data);
    }

    public function update(array $data, Post $post): Post
    {
        $post->update($data);

        return $post;
    }

    public function delete(Post $post): void
    {
        $post->delete();
    }

    public function search(string $title): LengthAwarePaginator
    {
        return Post::where('title', 'LIKE', '%' . $title . '%')->paginate();
    }
}