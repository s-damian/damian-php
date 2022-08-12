<?php

namespace App\Models;

use DamianPhp\Database\BaseModel;

/**
 * Example of a Model of auth attempts.
 * Security: Against brute force attacks.
 */
class Attempt extends BaseModel
{
    /*
    |--------------------------------------------------------------------------
    | Columns:
    |--------------------------------------------------------------------------
    */

    /**
     * Type int(11) - Attributs usigned - Null no - Index primary key - Extra auto_increment
     */
    public int $id;

    /**
     * Type varchar(20) - Null no
     *
     * To avoid "conflicts" between several member areas.
     */
    public string $auth;

    /**
     * Type timestamp - Null yes
     *
     * Date when the visitor was blocked.
     */
    public ?string $date_blocking;

    /**
     * Type timestamp - Null no
     *
     * Date of the first wrong password entered.
     */
    public ?string $date_first_auth_failure;

    /**
     * Type varchar(20) - Null no
     *
     *  IP Address.
     */
    public string $ip;

    /**
     * Type varchar(255) - Null no
     *
     * Column on which to do the test (to block).
     */
    public string $field;

    /**
     * Type int(11) - Null no
     *
     * Number of attempts the visitor made.
     */
    public int $number_attempts;
}
