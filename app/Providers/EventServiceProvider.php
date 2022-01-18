<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\User;
use App\Models\Course;
use App\Models\Category;
use App\Models\Newsletter;
use App\Observers\PostObserver;
use App\Observers\UserObserver;
use App\Observers\CourseObserver;
use App\Observers\CategoryObserver;
use App\Observers\NewsletterObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(UserObserver::class);
        Post::observe(PostObserver::class);
        Course::observe(CourseObserver::class);
        Category::observe(CategoryObserver::class);
        Newsletter::observe(NewsletterObserver::class);
    }
}