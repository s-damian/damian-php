<?php

namespace App\Providers;

use DamianPhp\Routing\Route;
use DamianPhp\Routing\Router;

/**
 * Routing Service Provider.
 */
class RoutingServiceProvider
{
    /**
     * Function called when the application starts.
     */
    public function boot(): void
    {
        Router::pattern('id', Route::REGEX_ID);

        Router::pattern('slug', Route::REGEX_SLUG);

        Router::pattern('key', Route::REGEX_KEY);

        require_once basePath('routes/list.php');
    }
}
