# use DamianPhp\Facade\Route;

```php
<?php

// Pour activer l'internotialisation pour les Route du dessous
Router::trans(true);
// Pour désactiver l'internotialisation pour les Route du dessous
Router::trans(false);


// Pour éventuellement modifier la langue par défaut (avec session, cookie, ou géolocalisation par exemple).
// Que lorsque lang n'est pas précisé dans URL que ça redirige vers nouvelle lang par defaut.
// !!! doit être exécuté tout en haut de la liste des routes.
Router::setDefaultLang('en');

// return string - La langue (soit cette par défaut de config, soit la langue choisie par l'utlisateur en ce basant sur l'URL).
Router::getLang();


// On peut éventuellement ajouter des routeGroup, pour éventuel préfix, middleware(s), et namespace.
Router::group(['prefix' => '/admin', 'middleware' => 'admin_is_logged', 'namespace' => 'App\Http\Controllers\Site\\'], function () {
    // Les routes...
});

// Si plusieurs middleware dans un routeGroup :
Router::group(['middleware' => ['middleware1', 'middleware2']], function () {
    // Les routes...
});

// On peut imbriquer plusieurs routeGroup les uns dans les autres.


// Resources (le 2è paramètre est un array d'options qui est OPTIONAL)
Router::resource('PageController', ['prefix' => 'admin_article']);
Router::resource('PageController', ['except' => ['show']]);
Router::resource('PageController', ['only' => ['index', 'create']]);
// Dans le array d'opations, on ne peut pas avoir 'except' et 'only'.

// Gère :
/*
 * @index GET/HEAD     : '/resource'
 * @create GET/HEAD    : '/resource/create'
 *   @store POST       : '/resource/create'
 * @show GET/HEAD      : '/resource/{id}'
 * @edit GET/HEAD      : '/resource/{id}/edit'
 *   @update PUT/PATCH : '/resource/{id}/edit'
 * @destroy DELETE     : '/resource/{id}/destroy'
*/


// Route en GET (Lire)
Router::get(
    '/contact',
    'App\Http\Controllers\Site\Pages\ContactController@getContact',
    ['name' => 'contact'] // args OPIONAL
);
// On est pas obligé de mettre 'App\Http\Controllers\' au début de Controller.
// On est pas obligé de mettre 'Controller' en fin de Controller.

// Route en GET avec paramètre et un where
Router::get(
    '/{slug}',
    'App\Http\Controllers\Site\PageController@show',
    ['name' => 'page_show']
)->where('slug', '[0-9a-z\-]+');

// Préciser regex directement depuis la méthode "boot()" de "App\Providers\RoutingServiceProvider"
// (where() sera prioritaire par rapport à pattern())
Router::pattern('slug', Route::REGEX_SLUG);

// Route en HEAD (Lire - entête seulement)
Router::head(
    '/contact',
    'App\Http\Controllers\Site\Pages\ContactController@postContact'
);

// Route en POST (Créer)
Router::post(
    '/contact',
    'App\Http\Controllers\Site\Pages\ContactController@postContact'
);

// Route en PUT (Mettre à jour)
Router::put(
    '/contact',
    'App\Http\Controllers\Site\Pages\ContactController@postContact'
);

// Route en PATCH (Partiellement mettre à jour)
Router::patch(
    '/contact',
    'App\Http\Controllers\Site\Pages\ContactController@postContact'
);

// Route en DELETE (Supprimer)
Router::delete(
    '/contact',
    'App\Http\Controllers\Site\Pages\ContactController@postContact'
);

// Route en OPTIONS (Toutes les méthodes HTTP + d'autres option)
Router::options(
    '/contact',
    'App\Http\Controllers\Site\Pages\ContactController@postContact'
);

// Route avec toutes les méthodes
Router::any(
    '/contact',
    'App\Http\Controllers\Site\Pages\ContactController@postContact'
);

// Route avec certaines méthodes
Router::match(
    ['GET', 'POST'],
    '/contact',
    'App\Http\Controllers\Site\Pages\HomeController@getHome'
);
// On n'est pas obligé de mettre "App\Http\Controllers" en début de namespace ou "Controllers" à la fin du nom du Controller.


// Redirection
Router::redirect(array $toRedirect, $whereRedirect, $optionalHttpResponseCodeParam);

// Executer le router
Router::dispatch();


// ********** Exemple pour une action "show" d'un Controller "Article" **********
// Pour ceci :
Router::get(
    '/{id}/{slug}',
    'Article@show',
    ['name' => 'article_show']
);

// Afficher une URL selon nom d'une route ("article_show"), et avec son "id" et son "slug" en paramètres :
echo Router::url('article_show', ['id' => $article->id, 'slug' => $article->slug]);
// **********/ Exemple pour une action "show" d'un Controller "Article" **********


// ********** Exemple pour une action "show" d'un Controller "Page" **********
// Pour ceci :
Router::get(
    '/{id}',
    'Page@show',
    ['name' => 'page_show_by_id']
);

$page = Page::load()->where('slug', '=', 'slug-1')->find();

// Afficher une URL avec selon nom d'une, et avec son "id" en paramètre :
// - Si on passe un array, il faut mettre un array associatif :
echo route('page_show_by_id',  ['id' => $page->id, 'slug' => $page->slug]);

// - Si on passe juste un objet, il faut juste mettre l'objet du Model :
echo route('page_show_by_id',  $page);
// C'est l'équivalent de ceci : ['id' => $page->id]

// - Si on passe juste un int ou un string, il faut juste mettre le mettre :
echo route('page_show_by_id',  $intOrString);
// C'est l'équivalent de ceci : ['id' => $page->id]
// ********** /Exemple pour une action "show" d'un Controller "Page" **********


// Dans liste des routes, on peut utiliser les closures :
Router::get('uri-test', function ($id, Request $request) {
    var_dunmp('Test');
});

// Il est possible d'utiliser dans n'importe quel ordre les matches et les injections dans paramètres des function.
// Et on peut aussi faire celà dans les actions des controllers.
```
