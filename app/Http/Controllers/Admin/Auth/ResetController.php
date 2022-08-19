<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Models\User;
use DamianPhp\Support\Facades\Hash;
use DamianPhp\Validation\Validator;
use App\Http\Controllers\Controller;
use DamianPhp\Support\Facades\Input;
use DamianPhp\Support\Facades\Security;

/**
 * Syntax example of a Reset Controller.
 */
class ResetController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->setLayout('admin-auth');
    }

    /**
     * Route GET /reset/{id}/{key}
     *
     * Show reset view.
     *
     * @param int $id - Id de l'user
     * @param string $key - Key reset de l'user
     */
    public function reset(int $id, string $key)
    {
        $result = User::load()->select('id')->where('id', '=', $id)->where('key_reset', '=', Security::hash($key))->find();

        if (! $result) {
            getError404();
            return;
        }

        return $this->view('admin/auth/reset', compact('id', 'key'));
    }

    /**
     * Route POST /reset/{id}/{key}
     *
     * Traitement du reset
     *
     * @param int $id - Id de l'user
     * @param string $key - Key reset de l'user
     * @param Validator $validator
     */
    public function postReset(int $id, string $key, Validator $validator)
    {
        $validator->rules([
            'email' => [
                'required' => true,
                'verify_with_db_data' => [
                    'model' => User::class,
                    'column' => 'email',
                    'where' => [['id', '=', $id, 'AND'], ['key_reset', '=', Security::hash($key)]],
                    'data_to_verify' => Input::post('email'),
                    'error_message' => 'Addresse mail incorrect !',
                ],
            ],
            'password' => [
                'min'=>5,
                'max'=>64,
                'required'=>true,
                'confirm'=>[Input::post('password'),Input::post('password_confirm')]
            ],
            'password_confirm' => ['required'=>true],
        ]);

        if ($validator->isValid()) {
            $user = User::load()->findOrFail($id);
            $user->setPassword(Hash::hash(Input::post('password')));
            $user->setKeyReset(null);
            $user->setDateKeyResetInsert(null);
            $user->save();

            return $this->withSuccess('Your password has been changed.')->redirect(route('admin_login'));
        }

        return $this->withErrors($validator->getErrorsHtml())->reset($id, $key);
    }
}
