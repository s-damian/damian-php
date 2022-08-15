## * Sommaire *

* Pour dans controllers
* Middlewares
* Cookie
* Input
* Request
* Json
* Response



# Namespcace Core\Http\Controller (pour dans controllers)

```php
<?php

// Utiliser un autre layout que celui par defaut
$this->setLayout('admin');

// Utiliser une autre extension que "php"
$this->setExtension('html');

// Ajouter CSS spécifique(s)
$this->addCss('feuille-css-1')->addCss('feuille-css-2');
// on peut aussi faire comme ceci
$this->addCss(['feuille-css-1', 'feuille-css-2']);

// Ajouter JS spécifique(s)
$this->addJs('fichier-js-1')->addJs('fichier-js-2');
// on peut aussi faire comme ceci
$this->addJs(['fichier-js-1', 'fichier-js-2']);

// Ajouter des valeurs au $data à envoyer dans vue
$this->addData(['key1'=>'value1'])->addData(['key2'=>'value2']);
// On peut aussi faire comme ceci
$this->addData(['key1'=>'value1', 'key2'=>'value2']);

// Retourner la vue. En 1er paramètre il faut mettre le path, en 2è paramètre il faut passer les éventuelles data
$this->view('dossier/vue', [
    'data1' => $data1,
    'data2' => $data2,
]);

// Middleware
// Un seul :
$this->middleware('mdw');
// Plusieurs :
$this->middleware(['mdw1', 'mdw1']);

// Message flash de confirmation avant redirection
$this->withOk('Message de confirmation')->redirect(route('name_route'));

// Message flash aves les erreurs avant redirection
$this->withErrors($this->validator->getErrors())->redirect(route('name_route'));

// Redirection
$this->redirect(route('name_route'));

// Spécifier l'en-tête HTTP de l'affichage d'une vue
$this->header('Content-Type', 'text/xml');
```



# Middlewares
// Dans app/Http/Middlewares/Kernel.php
// La liste des routes est à mettre dans :
protected $routeMiddleware = [
    'admin_is_logged' => ['App\Http\Middlewares\Admin\IsLogged', 'isConnected'],
    'admin_token_csfr' => 'App\Http\Middlewares\Admin\Token'],
];
/**
* Dans $routeMiddleware - Pour charger une Classe et une Method spécifique :
* 'key' => ['classe à charger', 'sa method à executer'],
*
* Pour charger une Class
* 'key' => 'classe à charger',
*/

/*
* Les classes des Middlewares sont dans des dossiers dans app/Http/Middleware
*
* Pour charger une classe des Middleware dans un Controller :
* $this->middleware('key');
* Ou pour en charger plusieurs :
* $this->middleware(['key', 'key2']);
*
* Pour charger une classe des Middleware dans routes :
* Router::group(['prefix'=>'/admin', 'middleware'=>'key'], function() { ...
* Ou pour en charger plusieurs :
* Router::group(['prefix'=>'/admin', 'middleware'=>['key', 'key2']], function() { ...
*/




# use DamianPhp\Support\Facades\Cookie;

```php
<?php

// Créer/modifier un cookie
Cookie::put('name', 'valeur', 'temps');
// Si on ne met pas de 'temps', prendre le lifetim par default dans confir/cookie.php

// Supprimer un cookie
Cookie::destroy('name');

// Vérifier si un cookie existe
if (Cookie::has('name')) {
    // OK...
} else {
    // erreur...
}

// return mixed - Valeur du cookie
Cookie::get('name');
```




# use DamianPhp\Support\Facades\Input;

```php
<?php

// return bool - Verifier si donnée envoyée en POST de ce name existe
Input::hasPost('submit');

// return mixed - Si donnée envoyee en POST, et ce que name existe -> retourner sa valeur 
Input::post('title');


// return bool - Verifier si donnée envoyée en GET de ce name existe
Input::hasGet('submit');

// return mixed - Si donnée envoyée en GET, et que ce name existe, retourner sa valeur 
Input::get('search');


// return bool - verifier si donnée envoyée en FILES existe
Input::hasFile('file_img');

// return mixed - Si donnée envoyée en FILE, et si ce $name existe -> retourner sa valeur 
Input::file('file_img');
```




# use DamianPhp\Support\Facades\Request;

```php
<?php

// return Object
Request::getPost();

Request::getPost()->all();

Request::getPost()->keys();

Request::getPost()->count();

Request::getPost()->has(string $key);

Request::getPost()->get(string $key, $default = '');

Request::getPost()->set(string $key, $value);

Request::getPost()->destroy(string $key);

Request::getPost()->clear();


// return Object
Request::getGet();

Request::getGet()->all();

Request::getGet()->keys();

Request::getGet()->count();

Request::getGet()->has(string $key);

Request::getGet()->get(string $key, $default = '');

Request::getGet()->set(string $key, $value);

Request::getGet()->destroy(string $key);

Request::getGet()->clear();


// return Object
Request::getCookies();

Request::getCookies()->all();

Request::getCookies()->keys();

Request::getCookies()->count();

Request::getCookies()->has(string $key);

Request::getCookies()->get(string $key, $default = '');

Request::getCookies()->set(string $key, $value);

Request::getCookies()->destroy(string $key);

Request::getCookies()->clear();


// return Object
Request::getServer();

Request::getServer()->all();

Request::getServer()->keys();

Request::getServer()->count();

Request::getServer()->has(string $key);

Request::getServer()->get(string $key, $default = '');

Request::getServer()->destroy(string $key);

Request::getServer()->clear();


// return Object
Request::getFiles();

Request::getFiles()->has(string $key);

Request::getFiles()->get(string $key, $default = '');


// return bool - True si request method est égale à méthode passée en paramètre
Request::isMethod('POST');

// return bool - True si request method est égale à une des méthodes passées en paramètre
Request::isInMethods(array $methods);

// return bool
Request::isGet();

// return bool
Request::isPost();

// return bool
Request::isPut();

// return bool
Request::isDelete();

// return bool
Request::isPatch();

// return bool
Request::isHead();

// return bool
Request::isOptions();

// return bool - True si méthode est appelée en Ajax
Request::isAjax();

// return bool - Si la requête c'est bien de la console
Request::isCli();

// return array - Verbs autorisés (en dehos de GET et POST) dans les méthodes des form
Request::getMethodsAllowedForInputMethod();

// return string - Méthode utilisée pour accéder à la page. 'GET', 'POST', 'PUT', 'PATCH', 'DELETE', etc.
Request::getMethod();

// return string - L'URL courante (sans les éventuels query params)
Request::getUrlCurrent();

// return string - L'URL courante (avec les éventuels query params)
Request::getFullUrlWithQuery();



// Méthodes magiques avec instance :
use DamianPhp\Http\Request\Request;

$request = new Request();

// return mixed, retournera valeur selon request method
$request->title;





# use DamianPhp\Support\Facades\Server;

// return string - Pour récupérer un paramètre de $_SERVER
Server::get(string $key);

// return string - POST ou GET
Server::getMethod();

// return string - L'URI qui a été fourni pour accéder à cette page
Server::getRequestUri();

// URI (URL après nom de domaine du site)
Server::getUri();

// return string - Le nom du serveur hôte qui exécute le script suivant.
Server::getServerName();

// return string - Contenu de l'en-tête Host: de la requête courante, si elle existe
Server::getHttpHost();

// return string - Nom de domaien(sans "www.")
Server::getDomainName();

// return string
Server::getDocumentRoot()();

// return string - L'adresse IP d'un visiteur
Server::getIp();

// return string - Contenu de l'en-tête User_Agent: de la requête courante, si elle existe
Server::getHttpUserAgent();
```




# use DamianPhp\Support\Facades\Json;

```php
<?php

// Modifier le contenu d'un fichier JSON
Json::set(string $file, $value);

// return string - Récupérer le contenu d'un fichier JSON
Json::get(string $file, bool $assoc=false);

// Encoder au format Json
Json::encode($value);

// Décoder du Json
Json::decode($value);
```




# use DamianPhp\Support\Facades\Response;

```php
<?php

// return int - Status code HTTP
echo Response::getHttpResponseCode();


// Spécifier l'en-tête HTTP de l'affichage d'une vue
Response::header(string $content, string $type = null);


// Redirection
Response::redirect('url');
// redirection 301 par exemple
Response::redirect('url', 301);


// return string - Retourner le contenu d'un fichier .php en string
Response::share(string $path, array $data = []);


// Pour messages de confirmation
Response::alertSuccess('message');

// Pour messages d'erreur
Response::alertError('message');

// Pour les messages de confirmations ou d'erreurs dans le site
Response::setAlert('class-css', 'message');
```
