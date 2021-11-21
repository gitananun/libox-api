<?php

namespace App\Http\Controllers;

use App\Services\StatisticService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use App\Jobs\ProcessStatisticReport;
use App\Http\Resources\PaginatorResource;
use App\Http\Resources\StatisticResource;

class StatisticController extends Controller
{
    public function __construct(private StatisticService $statisticService)
    {}

    private function makeReport(Collection $statistic)
    {
        return App::make('\Barryvdh\DomPDF\PDF')->loadView('statistic.report', ['stats' => $statistic]);
    }

    public function index()
    {
        ProcessStatisticReport::dispatchAfterResponse(
            $statistic = $this->statisticService->index(request()->type),
            $this->makeReport($statistic->getCollection())->download()
        );

        return response()->success(new PaginatorResource(StatisticResource::class, $statistic));
    }
}