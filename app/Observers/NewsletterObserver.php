<?php

namespace App\Observers;

use Location;
use App\Models\Newsletter;

class NewsletterObserver
{
    /**
     * Handle the Newsletter "create" event.
     *
     * @param  \App\Models\Newsletter $newsletter
     * @return void
     */
    public function creating(Newsletter $newsletter)
    {
        if ($position = Location::get()) {
            $newsletter->country = $position->countryName;
        }
    }
}