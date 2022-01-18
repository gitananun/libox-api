<?php

namespace App\Http\Controllers;

use App\Services\NewsletterService;
use App\Http\Requests\SubscribeNewsletterRequest;

class NewsletterController extends Controller
{
    public function __construct(private NewsletterService $newsletterService)
    {}

    public function subscribe(SubscribeNewsletterRequest $request)
    {
        $this->newsletterService->subscribe($request->email);

        return response()->message('Subscribed successfully!');
    }
}