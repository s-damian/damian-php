<?php

declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| App configuration.
|--------------------------------------------------------------------------
*/

return [

    /**
     * Application Environment.
     * Supported: 'local', 'preprod', 'production', 'testing'.
     *
     * string
     */
    'env' => env('APP_ENV', 'production'),

    /**
     * Application Debug Mode.
     *
     * bool
     */
    'debug' => (bool) env('APP_DEBUG', false),

    /**
     * Application URL
     *
     * string
     */
    'url' => env('APP_URL', 'http://localhost'),

    /**
     * Application Timezone
     *
     * string
     */
    'timezone' => 'Europe/Paris',

    /**
     * Default charset.
     *
     * string
     */
    'charset' => 'UTF-8',

    /**
     * To possibly put the website in maintenance (error 503).
     *
     * bool
     */
    'maintenance' => false,

    /**
     * IP addresses prohibited from accessing the website (error 403).
     *
     * array
     */
    'ip_forbidden' => [],

];
