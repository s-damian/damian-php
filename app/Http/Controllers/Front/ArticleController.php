<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

/**
 * Axample of a Controller for a Blog.
 */
class ArticleController extends Controller
{
    public function index()
    {
        return $this->view('front/article/index', [
            'title' => 'Home title',
        ]);
    }

    public function show(string $slug)
    {
        return $this->view('front/article/show', [
            'title' => 'Contact title',
            'slug' => $slug,
        ]);
    }
}
