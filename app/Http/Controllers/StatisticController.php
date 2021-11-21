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
        ProcessStatisticReport::dispatchAfterResponse(
            $statistic = $this->statisticService->index(request()->type)
        );

        return response()->success(new PaginatorResource(StatisticResource::class, $statistic));
    }
}