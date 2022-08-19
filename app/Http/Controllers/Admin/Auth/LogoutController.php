<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use DamianPhp\Support\Facades\Input;
use DamianPhp\Support\Facades\Cookie;
use DamianPhp\Support\Facades\Session;

/**
 * Syntax example of a Logout Controller.
 */
class LogoutController extends Controller
{
    /**
     * Route GET /admin/logout
     */
    public function logout()
    {
        if (Cookie::has('remember_admin')) {
            if (Session::has('admin_user')) {
                User::load()
                    ->where('username', '=', Session::get('admin_user')['username'])
                    ->limit(1)
                    ->update(['remember_token' => null]);
            }

            Cookie::destroy('remember_admin');
        }

        Session::clear();

        // Tf the user clicks on a "Logout btn": useful to be able to display the logout confirmation message.
        if (Input::hasGet('logout')) {
            return $this->redirect(route('admin_login').'?logout=ok');
        }

        return $this->redirect(route('admin_login'));
    }
}
