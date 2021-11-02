<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Course;
use App\Policies\CoursePolicy;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Course::class => CoursePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('email_verified', fn(User $user) => $user->email_verified_at !== null
                ? Response::allow()
                : Response::deny('Email is not verified')
        );

        Gate::define('is_admin', fn(User $user) => $user->isAdmin()
                ? Response::allow()
                : Response::deny('Role permissions denied')
        );
    }
}