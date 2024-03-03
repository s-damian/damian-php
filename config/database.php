<?php

declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| Database configuration.
|--------------------------------------------------------------------------
*/

return [

    /**
     * Default Database Connection Name.
     *
     * string
     */
    'default' => env('DB_CONNECTION', 'mysql'),

    /**
     * Database Connections.
     *
     * array
     */
    'connections' => [
        // MySQL
        'mysql' => [
            'driver' => 'mysql',
            'host' => env('APP_ENV') === 'testing' ? env('DB_HOST_TEST', '127.0.0.1') : env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('APP_ENV') === 'testing' ? env('DB_DATABASE_TEST') : env('DB_DATABASE'),
            'username' => env('APP_ENV') === 'testing' ? env('DB_USERNAME_TEST') : env('DB_USERNAME'),
            'password' => env('APP_ENV') === 'testing' ? env('DB_PASSWORD_TEST') : env('DB_PASSWORD'),
            'unix_socket' => env('DB_SOCKET'),
            'charset' => 'utf8mb4',
            'prefix' => '',
        ],

        // PostgreSQL
        'pgsql' => [
            'driver' => 'pgsql',
            'host' => env('APP_ENV') === 'testing' ? env('DB_HOST_TEST', '127.0.0.1') : env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '5432'),
            'database' => env('APP_ENV') === 'testing' ? env('DB_DATABASE_TEST') : env('DB_DATABASE'),
            'username' => env('APP_ENV') === 'testing' ? env('DB_USERNAME_TEST') : env('DB_USERNAME'),
            'password' => env('APP_ENV') === 'testing' ? env('DB_PASSWORD_TEST') : env('DB_PASSWORD'),
            'prefix' => '',
        ],
    ],

    /**
     * How to return PDO errors (only works if debug is true in ".config/app.php")
     * Supported: PDO::ERRMODE_EXCEPTION, PDO::ERRMODE_WARNING
     */
    'debug' => PDO::ERRMODE_EXCEPTION,

];
