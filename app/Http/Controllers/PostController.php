<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Services\PostService;
use App\Http\Resources\PostResource;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PaginatorResource;

class PostController extends Controller
{
    public function __construct(private PostService $postService)
    {}

    public function index()
    {
        return response()->success(new PaginatorResource(
            PostResource::class,
            $this->postService->index()
        ));
    }

    public function store(StorePostRequest $request)
    {
        $this->authorize('is_admin');

        $this->postService->store($request->all());

        return response()->stored();
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        $this->authorize('is_admin');

        $this->postService->update($request->all(), $post);

        return response()->stored();
    }

    public function delete(Post $post)
    {
        $this->authorize('is_admin');

        $this->postService->delete($post);

        return response()->deleted();
    }

    public function show(Post $post)
    {
        return response()->success(new PostResource($post));
    }

    public function search(string $title)
    {
        return response()->success(new PaginatorResource(
            PostResource::class, $this->postService->search($title)
        ));
    }

}