<?php

declare(strict_types=1);

use Dotenv\Dotenv;
use DamianPhp\Foundation\Application;

/*
|--------------------------------------------------------------------------
| Create the Application.
|--------------------------------------------------------------------------
*/

/**
 * Load environment variables.
 */
$dotenv = Dotenv::createImmutable(__DIR__.'/../');
$dotenv->load();

/**
 * Instantiate the Application.
 */
$app = new Application();
$app->startSession();
$app->ifError();
$app->initProviders();
$app->ifIpIsForbidden();
$app->ifIsMaintenance();

/**
 * Return Application.
 */
return $app;
