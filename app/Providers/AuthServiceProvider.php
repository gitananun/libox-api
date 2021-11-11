<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Course;
use App\Models\Category;
use App\Policies\CoursePolicy;
use App\Policies\CategoryPolicy;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Notifications\ResetPassword;
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
        Category::class => CategoryPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        ResetPassword::createUrlUsing(fn(User $user, string $token) =>
            config('customization.reset_password_url') . '?token=' . $token
        );

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