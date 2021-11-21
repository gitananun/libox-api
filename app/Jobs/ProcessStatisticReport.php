<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use App\Events\StatisticRequestedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Pagination\LengthAwarePaginator;

class ProcessStatisticReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(protected LengthAwarePaginator $statistic, protected mixed $report)
    {}

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        event(new StatisticRequestedEvent($this->statistic, $this->report));
    }
}