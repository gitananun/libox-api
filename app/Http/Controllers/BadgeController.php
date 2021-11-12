<?php

namespace App\Http\Controllers;

use App\Services\BadgeService;
use App\Http\Resources\BadgeResource;

class BadgeController extends Controller
{
    public function __construct(private BadgeService $badgeService)
    {}

    public function index()
    {
        return response()->success(
            BadgeResource::collection($this->badgeService->index())
        );
    }
}