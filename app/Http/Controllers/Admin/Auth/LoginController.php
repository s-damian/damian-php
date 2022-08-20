<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Models\User;
use DamianPhp\Auth\Auth;
use DamianPhp\Support\Facades\Hash;
use DamianPhp\Validation\Validator;
use App\Http\Controllers\Controller;
use DamianPhp\Support\Facades\Input;
use DamianPhp\Support\Facades\Session;
use DamianPhp\Support\Facades\Security;

/**
 * Syntax example of a Login Controller.
 */
class LoginController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->setLayout('admin-auth');
    }

    /**
     * Route GET /admin/login
     *
     * Show login view.
     */
    public function login()
    {
        // If the user is already connected: send him back to the admin homepage.
        if (Session::has('admin_user')) {
            return $this->redirect(route('admin_home'));
        }

        return $this->view('admin/auth/login');
    }

    /**
     * Route POST /admin/login
     */
    public function postLogin(Validator $validator)
    {
        $validator->rules([
            'username' => ['required' => true],
            'password' => ['required' => true],
        ]);

        if ($validator->isValid()) {
            return $this->attemptLogin();
        }

        return $this->withErrors($validator->getErrorsHtml())->login();
    }

    /**
     * Try to connect the user.
     */
    private function attemptLogin()
    {
        $result = User::load()
            ->select('id, role, username, first_name, password')
            ->where('username', '=', Input::post('username'))
            ->find();

        if (! $result || ! Hash::verify(Input::post('password'), $result->password)) {
            return $this->withErrors('Incorrect Username or Password.')->login();
        } else {
            $auth = new Auth(User::class);
            $auth->remember('remember_admin')->connect('admin_user', [
                'id' => (int) $result->id,
                'role' => (int) $result->role,
                'username' => $result->username,
                'first_name' => $result->first_name,
            ]);

            return $this->withSuccess('You just logged in as "'.Security::e(Session::get('admin_user')['username']).'".')
                ->redirect(route('admin_home'));
        }
    }
}
