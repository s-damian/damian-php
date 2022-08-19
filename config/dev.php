<?php

/*
|--------------------------------------------------------------------------
| Configuration for the development.
|--------------------------------------------------------------------------
*/

return [

    /**
     * Developer IP addresses (to perform certain actions, to display errors...).
     * If the website is in maintenance ('maintenance' to true), the website will not be in maintenance via these IPs.
     *
     * array
     */
    'dev_ip' => explode(',', env('DEV_IP')),

];
