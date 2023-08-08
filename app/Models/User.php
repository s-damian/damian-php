<?php

namespace App\Models;

use DamianPhp\Database\BaseModel;

/**
 * Example of a Model of users.
 */
class User extends BaseModel
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
     * Type timestamp
     *
     * @var - Date de création
     */
    public ?string $created_at;

    /**
     * Type varchar(255) - Null no
     *
     * @var string
     */
    public $avatar;

    /**
     * Type timestamp - Null yes
     *
     * @var
     */
    public ?string $date_key_reset_insert;

    /**
     * Type timestamp - Null yes
     *
     * @var
     */
    public ?string $date_last_connexion;

    /**
     * Type varchar(255) - Null no - Index unique key
     */
    public string $email;

    /**
     * Type varchar(255) - Null no
     */
    public string $first_name;

    /**
     * Type varchar(255) - Null yes
     */
    public ?string $key_reset;

    /**
     * Type varchar(255) - Null yes
     */
    public ?string $last_name;

    /**
     * Type varchar(255) - Null no
     */
    public string $password;

    /**
     * Type varchar(255) - Null yes
     */
    public ?string $remember_token;

    /**
     * Type varchar(255) - Null yes
     */
    public ?string $tel;

    /**
     * Type varchar(255) - Null no - Index unique key
     */
    public string $username;

    /**
     * Les attributs qui sont assignables en masse.
     */
    protected array $fillable = [
        'email',
        'first_name',
        'last_name',
        'tel',
        'username',
    ];
}
