<?php

namespace App\Http\Controllers\Front\Sitemap;

use App\Http\Controllers\Controller;
use App\Models\Article;

/**
 * Sitemap example.
 */
class SitemapController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->setLayout('sitemap');
    }

    public function sitemap()
    {
        return $this->view('front/sitemap/sitemap', [
            'articles' => Article::getFakeArticles(),
        ]);
    }
}
