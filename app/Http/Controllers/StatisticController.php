<?php

namespace App\Http\Controllers;

use App\Services\StatisticService;
use App\Http\Resources\PaginatorResource;
use App\Http\Resources\StatisticResource;

class StatisticController extends Controller
{
    public function __construct(private StatisticService $statisticService)
    {}

    public function index()
    {
        return response()->success(new PaginatorResource(
            StatisticResource::class,
            $this->statisticService->index(request()->type)
        ));
    }
}