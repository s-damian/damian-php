<?php

declare(strict_types=1);

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
    Router::get(
        '404',
        'Error@error404',
        ['name' => 'error404']
    );
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

// # Admin
Router::group(['prefix' => 'admin', 'namespace' => 'Admin\\'], function () {
    // # Auth
    Router::group(['namespace' => 'Auth\\'], function () {
        // ## Login
        Router::get(
            '/login',
            'Login@login',
            ['name' => 'admin_login']
        );
        Router::post(
            '/login',
            'Login@postLogin'
        );

        // ## Logout
        Router::get(
            '/logout',
            'Logout@logout',
            ['name' => 'admin_logout']
        );

        // ## Forgot
        Router::get(
            '/forgot',
            'Forgot@forgot',
            ['name' => 'admin_forgot']
        );
        Router::post(
            '/forgot',
            'Forgot@postForgot'
        );

        // ## Reset
        Router::get(
            '/reset/{id}/{key}',
            'Reset@reset',
            ['name' => 'admin_reset']
        );
        Router::post(
            '/reset/{id}/{key}',
            'Reset@postReset'
        );
    });

    Router::group(['middleware' => ['verify_csfr_token', 'admin_is_logged']], function () {
        // ## Admin homepage
        Router::get(
            '/home',
            'Home@home',
            ['name' => 'admin_home']
        );

        // ## Articles
        Router::group(['prefix' => '/articles'], function () {
            // - 'Article': is the Controller.
            // - 'prefix_name': is the prefix of routes that this resource will generate.
            // - 'except': because in our controller Article, we don't have the "show" action.
            Router::resource('Article', ['prefix_name' => 'admin_article_', 'except' => ['show']]);
        });
    });
});

// If you want to see all your routes:
//echo '<pre>'; var_dump( Router::getRoutes() ); die;
