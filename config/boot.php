<?php

declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| Application startup configuration.
|--------------------------------------------------------------------------
*/

return [

    /**
     * Autoloaded Service Providers.
     *
     * array
     */
    'providers' => [
        App\Providers\RoutingServiceProvider::class,
        App\Providers\ValidatorServiceProvider::class,
    ],

];
