<?php

namespace App\Http\Middlewares;

use DamianPhp\Support\Facades\Request;
use DamianPhp\Support\Facades\CsrfToken;

/**
 * To secure forms sent by POST method.
 */
class VerifyCsrfToken
{
    public function __construct()
    {
        CsrfToken::addSession(); // If no session token -> add it.

        $this->tokenPost();
    }

    /**
     * If form sent by POST method -> Check the token.
     */
    private function tokenPost(): void
    {
        if (Request::isInMethods(['POST', 'PUT', 'PATCH', 'DELETE'])) {
            CsrfToken::verifyPost();
        }
    }
}
