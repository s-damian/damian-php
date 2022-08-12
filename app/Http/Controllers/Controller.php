<?php

namespace App\Http\Controllers;

use DamianPhp\Http\Controller\BaseController;

/**
 * Application's parent Controller.
 */
abstract class Controller extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }
}
