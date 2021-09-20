<?php

namespace App\Providers;

use App\Jobs\PostCreated;
use App\Jobs\PostDeleted;
use App\Jobs\PostUpdated;
use App\Jobs\UserCreated;
use App\Jobs\UserDeleted;
use App\Jobs\UserUpdated;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->bind(PostCreated::class . '@handle', fn ($job) =>  $job->handle());
        $this->app->bind(PostDeleted::class . '@handle', fn ($job) =>  $job->handle());
        $this->app->bind(PostUpdated::class . '@handle', fn ($job) =>  $job->handle());
        $this->app->bind(UserCreated::class . '@handle', fn ($job) =>  $job->handle());
        $this->app->bind(UserUpdated::class . '@handle', fn ($job) =>  $job->handle());
        $this->app->bind(UserDeleted::class . '@handle', fn ($job) =>  $job->handle());
    }
}
