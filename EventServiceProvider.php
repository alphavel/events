<?php

namespace Alphavel\Events;

use Alphavel\Framework\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton('events', function () {
            return new EventDispatcher();
        });

        // Auto-register facade
        $this->facades([
            'Event' => 'events',
        ]);
    }

    public function boot(): void
    {
        //
    }
}
