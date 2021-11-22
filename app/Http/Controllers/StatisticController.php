<?php

namespace App\Http\Controllers;

use App\Services\StatisticService;
use App\Jobs\ProcessStatisticReport;
use App\Http\Resources\PaginatorResource;
use App\Http\Resources\StatisticResource;

class StatisticController extends Controller
{
    public function __construct(private StatisticService $statisticService)
    {}

    public function index()
    {
        $statistic = $this->statisticService->index(request()->type);

        ProcessStatisticReport::dispatchAfterResponse($statistic);

        return response()->success(new PaginatorResource(StatisticResource::class, $statistic));
    }
}