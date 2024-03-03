<?php

declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| Mail configuration.
|--------------------------------------------------------------------------
*/

return [

    /**
     * Default Mailer.
     * Supported: 'mail', 'smtp'
     *
     * string
     */
    'driver' => env('MAIL_DRIVER'),

    /**
     * SMTP Host Address.
     * (useful only if 'driver' has 'smtp' as value)
     *
     * string
     */
    'host' => env('MAIL_HOST'),

    /**
     * SMTP Host Port.
     * (useful only if 'driver' has 'smtp' as value)
     *
     * int
     */
    'port' => env('MAIL_PORT'),

    /**
     * E-Mail Encryption Protocol.
     * (useful only if 'driver' has 'smtp' as value)
     *
     * string
     */
    'encryption' => env('MAIL_ENCRYPTION'),

    /**
     * SMTP Server Username.
     * (useful only if 'driver' has 'smtp' as value)
     *
     * string
     */
    'username' => env('MAIL_USERNAME'),

    /**
     * SMTP Server Password.
     * (useful only if 'driver' has 'smtp' as value)
     *
     * string
     */
    'password' => env('MAIL_PASSWORD'),

    /**
     * Sendmail System Path.
     *
     * string
     */
    'sendmail' => '/usr/sbin/sendmail -bs',

    /*
    |--------------------------------------------------------------------------
    | DKIM:
    |--------------------------------------------------------------------------
    */

    /**
     * DKIM - Path of the private key.
     *
     * null|string
     */
    'dkim_private_key' => env('MAIL_DKIM_PRIVATE_KEY'),

    /**
     * DKIM - Domain.
     *
     * string
     */
    'dkim_domain' => env('MAIL_DKIM_DOMAIN'),

    /**
     * DKIM - DNS level selector.
     *
     * string
     */
    'dkim_selector' => env('MAIL_DKIM_SELECTOR'),

];
