<?php

use DamianPhp\Support\Helper;
use DamianPhp\Support\Facades\Json;
use DamianPhp\Support\Facades\Input;
use DamianPhp\Support\Facades\Cookie;
use DamianPhp\Support\Facades\Router;

/*
|--------------------------------------------------------------------------
| Here is where you can register web routes for your application.
|--------------------------------------------------------------------------
*/

// # Lang
if (Helper::isMultilingual()) {
    // pour rediriger vers : domain.com/lang/ (si pas de Lang précisé dans l'URL)
    if (config('lang.address_structure') === 'subdirectories') {
        Router::trans(true);

        if (Cookie::has('lang')) {
            Router::setDefaultLang(Cookie::get('lang'));
        }

        // si clic sur un flag de Lang -> créer (ou modifier) cookie "lang"
        Router::post('set_cookie_lang_with_ajax', function () {
            Cookie::put('lang', Input::post('lang')); // durrée de vie : 1 an
        });
    }
}

// # Errors
Router::group(['namespace' => 'Error\\'], function () {
    require_once __DIR__.'/includes/errors.php';
});

// # Front
Router::group(['namespace' => 'Front\\'], function () {
    // Home page
    Router::get(
        '',
        'Page@home',
        ['name' => 'home']
    );
    // Contact page
    Router::get(
        'contact',
        'Page@contact',
        ['name' => 'contact']
    );
    Router::post(
        'contact',
        'Page@postContact'
    );

    // Articles
    Router::group(['prefix' => 'blog'], function () {
        // Article index
        Router::get(
            '',
            'Article@index',
            ['name' => 'article_index']
        );
        // Article show
        Router::get(
            '/{slug}',
            'Article@show',
            ['name' => 'article_show']
        );
    });

    # Callable example
    Router::get('callable-example', function () {
        echo Json::encode([
            'message' => 'Callable example.',
        ]);
    });

    // # Feeds
    Router::group(['namespace' => 'Sitemap\\'], function () {
        // Sitemap
        Router::get(
            'sitemap',
            'Sitemap@sitemap'
        );
    });
});
