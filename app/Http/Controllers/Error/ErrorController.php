<?php

namespace App\Http\Controllers\Error;

use App\Http\Controllers\Controller;
use DamianPhp\AppContracts\Http\Controllers\Error\ErrorInterface;

/**
 * Error management.
 */
class ErrorController extends Controller implements ErrorInterface
{
    /**
     * Show 404 error page (page not found).
     */
    public function error404()
    {
        return $this->header('HTTP/1.0 404 Not Found')->view('error/404');
    }

    /**
     * Show 503 error page (website under maintenance).
     */
    public function error503()
    {
        return $this->header('HTTP/1.1 503 Service Temporarily Unavailable')
            ->header('Status: 503 Service Temporarily Unavailable')
            ->header('Retry-After: 300')
            ->setLayout('empty')
            ->view('error/503');
    }

    /**
     * Show 403 error page (forbiden - no right to access the website).
     */
    public function error403()
    {
        return $this->header('HTTP/1.0 403 Forbidden')->setLayout('empty')->view('error/403');
    }

    /**
     * Show 403 attempt page (403 forbiden - not the right to access the site because number of connection attempts exceeded).
     *
     * @param int $durationBlocking - Duration of blocking WHERE IP.
     */
    public function attempt(int $durationBlocking)
    {
        return $this->header('HTTP/1.0 403 Forbidden')
            ->setLayout('empty')
            ->view('error/attempt', [
                'durationBlocking' => $durationBlocking,
            ]);
    }
}
