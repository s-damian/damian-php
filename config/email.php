<?php

/*
|--------------------------------------------------------------------------
| Email addresses configuration.
|--------------------------------------------------------------------------
*/

return [

    /**
     * If you want to send an email when there is an exception, you have to put true.
     *
     * bool
     */
    'send_mail_if_exception' => (bool) env('EMAIL_SEND_MAIL_IF_EXCEPTION', false),

    /**
     * Email(s) that will receive the exceptions (and possibly other errors).
     *
     * array
     */
    'email_error_to' => explode(',', env('EMAIL_EMAIL_ERROR_TO')),

    /**
     * Email that will send exception emails (and possibly other errors).
     *
     * string
     */
    'email_error_from' => env('EMAIL_EMAIL_ERROR_FROM'),

];
