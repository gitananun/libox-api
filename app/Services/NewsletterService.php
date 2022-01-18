<?php

namespace App\Services;

use App\Models\Newsletter;

class NewsletterService
{
    public function subscribe(string $email): void
    {
        Newsletter::create(['subscriber' => $email]);
    }
}