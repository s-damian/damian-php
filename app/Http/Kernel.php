<?php

namespace App\Http;

use DamianPhp\Http\HttpKernel;

/**
 * The App Kernel.
 *
 * - To load a Middleware class into Controllers:
 * $this->middleware('key');
 * - Or to load several:
 * $this->middleware(['key', 'key2']);
 *
 * - To load a Middleware class into routes:
 * Router::group(['prefix'=>'/admin', 'middleware'=>'key'], function () { ...
 * - Or to load several:
 * Router::group(['prefix'=>'/admin', 'middleware'=>['key', 'key2']], function () { ...
 */
class Kernel extends HttpKernel
{
    /**
     * The application's route middleware.
     *
     * - To load a specific class and method:
     * 'key' => ['class to load', 'his method to execute'],
     *
     * - Pour charger une Class :
     * 'key' => 'class to load',
     */
    protected array $routeMiddleware = [
        'verify_csfr_token' => \App\Http\Middlewares\VerifyCsrfToken::class,

        // Admin (This is an example of Middleware. This is useful if you want to add an Admin protected by authentication) :
        'admin_is_logged' => [\App\Http\Middlewares\Admin\IsLogged::class, 'isConnected'],
    ];
}
