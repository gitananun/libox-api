<?php

namespace App\Http\Controllers;

use App\Services\StatisticService;

class StatisticController extends Controller
{
    public function __construct(private StatisticService $statisticService)
    {}
}