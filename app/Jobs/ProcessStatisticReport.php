<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\App;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Notifications\Statistic\StatisticReported;

class ProcessStatisticReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(protected LengthAwarePaginator $statistic)
    {}

    private function makeReport(Collection $statistic)
    {
        return App::make('\Barryvdh\DomPDF\PDF')->loadView('statistic.report', ['stats' => $statistic]);
    }

    public function handle()
    {
        User::auth()->notify(new StatisticReported(
            $this->statistic,
            $this->makeReport($this->statistic->getCollection())->download()
        ));
    }

}