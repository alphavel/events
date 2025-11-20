<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Event Configuration
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | Event Listeners
    |--------------------------------------------------------------------------
    |
    | Register event listeners here
    |
    | Format:
    | 'event.name' => [
    |     ListenerClass::class,
    |     [AnotherListener::class, 'method'],
    | ],
    |
    */

    'listeners' => [
        // Example:
        // 'user.created' => [
        //     \App\Listeners\SendWelcomeEmail::class,
        //     \App\Listeners\CreateUserProfile::class,
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Event Subscribers
    |--------------------------------------------------------------------------
    |
    | Event subscribers listen to multiple events
    |
    */

    'subscribers' => [
        // Example:
        // \App\Subscribers\UserEventSubscriber::class,
    ],
];
