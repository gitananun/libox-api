<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Broadcasting\InteractsWithSockets;

class StatisticRequestedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public LengthAwarePaginator $statistic)
    {}
}