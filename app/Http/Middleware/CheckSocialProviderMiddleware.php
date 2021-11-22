<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckSocialProviderMiddleware
{
    const SOCIAL_PROVIDERS = ['github'];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!in_array($request->provider, $this::SOCIAL_PROVIDERS)) {
            return response()->message('Invalid social provider', 422);
        }

        return $next($request);
    }
}