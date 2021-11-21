<?php

namespace App\Listeners;

use App\Models\User;
use App\Notifications\Statistic\StatisticReported;

class SendStatisticReportListener
{
    /**
     * Handle the event.
     *
     * @param  object $event
     * @return void
     */
    public function handle($event)
    {
        User::auth()->notify(new StatisticReported($event->statistic, $event->report));
    }
}