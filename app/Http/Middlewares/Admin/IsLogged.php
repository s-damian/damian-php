<?php

namespace App\Http\Middlewares\Admin;

use App\Models\User;
use DamianPhp\Support\Helper;
use DamianPhp\Auth\IsConnected;
use DamianPhp\Support\Facades\Session;

/**
 * This is an example of Middleware.
 * This is useful if you want to add an Admin protected by authentication.
 *
 * Check that visitor is an authenticated member of the Admin.
 */
class IsLogged
{
    /**
     * Check authorization.
     */
    public function isConnected(): void
    {
        $isConnected = new IsConnected(User::class);

        $isConnected->session('admin_user', ['id', 'role', 'username', 'first_name'], ['id', 'role'])
            ->cookie('remember_admin')
            ->urlToredirectIfFalse(route('admin_login'));

        if (!$isConnected->isLogged()) {
            $isConnected->exit();
        }
    }
}
