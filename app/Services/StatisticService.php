<?php

namespace App\Services;

use App\Models\Statistic;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

class StatisticService
{
    private function getQuery(?string $type): Builder
    {
        return $type ? Statistic::where(['type' => strtoupper($type)]) : Statistic::query();
    }

    public function index(?string $type): LengthAwarePaginator
    {
        return $this->getQuery($type)->paginate(100);
    }
}