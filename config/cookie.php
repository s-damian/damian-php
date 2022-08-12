<?php

use DamianPhp\Support\Facades\Server;

/*
|--------------------------------------------------------------------------
| Cookie configuration.
|--------------------------------------------------------------------------
*/

return [

    /**
     * Session Cookie Lifetime (in minutes).
     *
     * int
     */
    'expire' => 60 * 24 * 7 * 54, // 60 min * 24 H * 7 jours * 54 semaines = environs 1 an

    /**
     * Session Cookie Path.
     *
     * string
     */
    'path' => '/',

    /**
     * Session Cookie Domain.
     *
     * string
     */
    'domain' => env('SESSION_DOMAIN'),

    /**
     * HTTPS Only Cookies.
     * Indicates whether the cookie should only be transmitted over a secure HTTPS connection from the client.
     *
     * bool
     */
    'secure' => Server::getRequestScheme() === 'https' ? true : false,

    /**
     * HTTP Access Only.
     * When this parameter is true, the cookie can only be accessed by the HTTP protocol (will not be editable in JS...).
     *
     * bool
     */
    'httponly' => true,
    
];
