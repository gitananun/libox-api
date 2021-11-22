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
        return response()->success(new PostResource($this->postService->store($request->all())));
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        return response()->success(new PostResource($this->postService->update($request->all(), $post)));
    }

    public function delete(Post $post)
    {
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