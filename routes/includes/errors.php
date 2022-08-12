<?php

use DamianPhp\Support\Facades\Router;

Router::get(
    '404',
    'Error@error404',
    ['name' => 'error404']
);
