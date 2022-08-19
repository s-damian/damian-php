<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->setLayout('admin');
    }

    /**
     * Route GET /admin/home
     */
    public function home()
    {
        return $this->view('admin/home/home');
    }
}
