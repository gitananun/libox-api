<?php

namespace App\Observers;

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
        $newsletter->country = 'Armenia';
    }
}