<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Models\User;
use DamianPhp\Mail\Mailer;
use DamianPhp\Support\Facades\Str;
use DamianPhp\Support\Facades\Date;
use DamianPhp\Validation\Validator;
use DamianPhp\Support\Facades\Input;
use App\Http\Controllers\Controller;
use DamianPhp\Support\Facades\Server;
use DamianPhp\Support\Facades\Session;
use DamianPhp\Support\Facades\Security;

/**
 * Syntax example of a Forgot Controller.
 */
class ForgotController extends Controller
{
    private const RESPONSE_MESSAGE = 'If your email address is valid, you will receive a message.';

    public function __construct()
    {
        parent::__construct();

        $this->setLayout('admin-auth');
    }

    /**
     * Route GET /admin/forgot
     *
     * Show forgot view.
     */
    public function forgot()
    {
        // If the user is already connected: send him back to the admin homepage.
        if (Session::has('admin_user')) {
            return $this->redirect(route('admin_home'));
        }

        return $this->view('admin/auth/forgot');
    }

    /**
     * Route POST /admin/forgot
     */
    public function postForgot(Validator $validator)
    {
        $validator->rules([
            'email' => ['required' => true],
        ]);

        if (! $validator->isValid()) {
            return $this->withErrors($validator->getErrorsHtml())->forgot();
        }

        $email = Input::hasPost('email') ? Security::noCrlf(Input::post('email')) : null;

        $result = User::load()->select('id')->where('email', '=', $email)->find();

        if (! $result) {
            return $this->withSuccess(self::RESPONSE_MESSAGE)->redirect(route('admin_forgot'));
        }

        return $this->sendMailToUser($email);
    }

    private function sendMailToUser(string $email)
    {
        $randomKey = Str::random(35);
        $encryptedRandomKey = Security::hash($randomKey);

        User::load()
            ->where('email', '=', $email)
            ->limit(1)
            ->update([
                'key_reset' => $encryptedRandomKey,
                'date_key_reset_insert' => Date::getDateTimeFormat(),
            ]);

        $user = User::load()->where('email', '=', $email)->find();

        $mailer = $this->send($randomKey, $user);

        if ($mailer->send()) {
            return $this->withSuccess(self::RESPONSE_MESSAGE)->redirect(route('admin_forgot'));
        }

        return $this->withErrors('An error has occurred.')->redirect(route('admin_forgot'));
    }

    private function send(string $randomKey, User $user): Mailer
    {
        $data = [
            'username_to' => $user->username,
            'id' => $user->id,
            'key' => $randomKey,
            'dateLimit' => self::getDateTimeMinMoreDay(Date::getDateTimeFormat(), 1),
        ];

        $mailer = new Mailer();
        $mailer->setFrom(config('email._email_from'))
            ->setTo($user->email)
            ->setSubject(Server::getServerName().' - Resetting your Password')
            ->setBody('admin/auth/forgot-html', $data)
            ->addBodyText('admin/auth/forgot-text', $data);

        return $mailer;
    }

    private static function getDateTimeMinMoreDay(string $value, int $moreDay): string
    {
        return date('d/m/Y', strtotime($value . '+'.$moreDay.' day')).' à '.date('H', strtotime($value)).'h'.date('i', strtotime($value));
    }
}
