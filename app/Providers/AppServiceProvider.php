<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Response::macro('success', fn($value) =>
            Response::make([
                'success' => true,
                'body' => $value,
            ], 200)
        );

        Response::macro('stored', fn() =>
            Response::make([
                'success' => true,
                'body' => 'Data stored successfully',
            ], 200)
        );

        Response::macro('message', fn($value, $statusCode = 200) =>
            Response::make([
                'success' => $statusCode >= 200 && $statusCode <= 299 ? true : false,
                'message' => $value,
            ], $statusCode ? $statusCode : 200)
        );

    }
}