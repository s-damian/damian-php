## * Sommaire *

* Attempt
* Security
* Token
* Lang
* Slug
* Str
* Helpers




# use DamianPhp\Support\Security\Attempt;

```php
<?php

// L'objectif :
// _A chaque foit qu'un user WHERE condition (ip ou username par exemple) tente une autentification :
//  Si user a dépassé le nombre de tentatives autorisé, on le bloque de ce formulaire.
// _A chaque foit qu'un user WHERE condition (ip ou username par exemple) échoue sa tentative d'autentification :
//  On incrémente 'number_attempts'.
//
// PS : inutile de mettre une valeur suppérieur à 1440 dans setDurationBlocking(),
// car on toutes les lignes qui sont + vielle de 24H


// Pour si on veut limiter par username
$attempt = new Attempt('mysql', 'admin', Server::getIp());

// Pour si on veut limiter par IP
$attempt = new Attempt('mysql', 'admin', Input::post('username'));


$attempt
    ->setLimitAttempt(5)  // Limitation autorisée de tentatives par 24H - Est optionel : vaut 40 par défaut.
    ->setDurationBlocking(2);  // Durrée (en minuttes) du blockage - Est optionel : vaut 720 (12 heures) par défaut (Il ne pas mettre + de 1440).

if (!$attempt->isAuthorized()) {
    return $attempt->getError();
}


if (!$authSuccess) {
    $attempt->increment();
}

```




# use DamianPhp\Support\Facades\Security;

```php
<?php

// return string - Contre faille XSS - pour sécuriser les echo
Security::e(string $velue);

// return string - Contre faille CRLF
$email = Security::noCrlf(Input::post('email'));

// *** Extentions upload ***
// return string - Connaitrer extention d'un fichier
Security::getExtFile($fichier);

// return array - Verifier que extention du fichier uploadé est bien celui d'un fichier autorisé
Security::extsFileValid()

// return array - Verifier que extention du fichier uploadé est bien celui d'un document
Security::extsDocValid()

// return array - Verifier que extention du fichier uploadé est bien celui d'une image
Security::extsImgValid()
// *** /extentions upload ***
```




# use DamianPhp\Support\Facades\CsrfToken::;

```php
<?php

// On passe une key en param - pour si plusieurs espaces membres -> donner diff nom de session token

// Ajouter token (à mettre dans class où on verfi si user est bien un membre autorisé de l'admin)
CsrfToken::addSession();

// return string - A mettre dans <form> qui sont envoyés en POST
echo CsrfToken::htmlPost();

// A mettre dans traitement des form envoyés en POST
CsrfToken::verifyPost();

// return string - A mettre dans <a href=""> qui sont envoyés en GET
echo CsrfToken::htmlGet('optional_operator');

// A mettre dans traitement des form envoyés en GET
CsrfToken::verifyGet();
```




# use DamianPhp\Support\String\Lang;

Pour afficher balise hreflang avec les bonnes URL en href :
```php
<?php

if (isMultilingual()) {
    Lang::addSpecificHreflang([
        'fr' => 'slug-fr',
        'en' => 'slug-en',
        'es' => 'slug-es',
    ]);

    Lang::addHreflang();

    echo Lang::getHreflang();
}
```

Pour ensuite afficher balise drapeaux avec les bonnes URL en href :
```php
<?php


if (isMultilingual()) {
    echo Lang::getImglangActive();
    echo Lang::getImglang();
}
```




# use DamianPhp\String\Media;

```php
<?php

echo Media::getVideo(
    BASE_URL.'/medias/videos/chat', ['webm', 'ogg', 'mp4'], ['width'=>400,'height'=>300, 'poster'=>BASE_URL.'/medias/chatfe.png']
);

echo Media::getAudio(
    BASE_URL.'/medias/audio/res', ['mp3', 'ogg'], ['class'=>'css']
);
```




# use DamianPhp\Support\Facades\Slug;

```php
<?php

// Créer un slug - que des carratcères alphanumériques en minuscules seront retournés, et espaces transformés en tirets
$url = Slug::create($title)

// Créer un "slug" pour les mots clés - les espaces transformés en virgules
$keywords = Slug::createKeywords($description);
```




# use DamianPhp\Support\Facades\Str;

```php
<?php

// return string - pour menu actif
echo Str::active('CONSTANTE');

// return string - pour sous menu actif
echo Str::active2('CONSTANTE');

// return string - Pour pouvoir "cumuler" les liens. Si de(s) GET passé(s) dans l'URL
// en param, array si plusieurs
Str::andIfHasQueryString(['page', 'pp']);
// ou string si un seul
Str::andIfHasQueryString('category');

// Déterminer si une chaîne donnée contient une sous-chaîne donnée
Str::contains(string $haystack,  string $needle);

// Pour remplacer format camelCase  par format snake_case
Str::convertCamelCaseToSnakeCase(string $camelCase);

// Pour remplacer format snake_case par format camelCase
Str::convertSnakeCaseToCamelCase(string $snake_case);

// return string -  l'extrait d'un texte
echo Str::extract($content, 250);

// return string - return l'extrait d'un texte pour une attr alt d'une img
echo Str::extractAlt($content, 25);
// le 2ème param est OPTIONAL

// return string - extrait d'un texte sans couper un mot, et remplace les balise H2 par des h3...
echo Str::extractWithReplaceH2PerH3(string $valueStr, int $limit);

// return string - extrait d'un texte sans couper un mot, et remplace les balise H2 par des h4...
echo Str::extractWithReplaceH2PerH4(string $valueStr, int $limit);

// return string - extrait d'un texte sans couper un mot, et remplace les balise H2 par des h5...
echo Str::extractWithReplaceH2PerH5(string $valueStr, int $limit);

// return string - Si plusieurs email séparés par virgules -> récupérer le 1er email
echo Str::firstEmail(string $email);

// return string - Si plusieurs TEL séparés par virgules -> récupérer le 1er TEL
echo Str::firstTel(string $email);

// return string - pour afficher un fil d'arianne
echo Str::getBreadcrumb(array $items, array $options=[]);

// return string - Pour pouvoir "cumuler" les <select> si il y en a déjà à $_GET
// en param, array si plusieurs
Str::inputHiddenIfHasQueryString(['search', 'category']);
// ou string si un seul
Str::inputHiddenIfHasQueryString('category');

// return string - chaine de carractères aléatoires
echo Str::random($optionalNbChars);

// Obtenir la forme plurielle d'un mot anglais
Str::snakePlural(string $camelCase);

// return string - Surligner si search dans liste
echo Str::surligneIfSearch(string $title, array $options);

// return string - Convertir un TEL en format international
echo Str::telInternationalFormat(string $tel, array $options=[]);
```




# Helpers

```php
<?php

// return string - Path du dossier racine public
publicPath(string $file=null);

// return string - Path du dossier racine qui contient toute l'application
basePath(string $file=null);

// return string - Pour liens d'URL en absolues
getBaseUrl();

// return string - Retourne un lien en absolue selon le nom d'une route :
route('route_name');
// et si il y a des paramètres dans URL :
route('route_name', ['id'=>'id-post', 'slug'=>'slug-post']);
// si il y a que 1 paramètre dans URL, et que c'est un object (avec une propriété "id"), un entier ou un string -> pas besoin de array

// return string - Retourne l'URL courante en bsolue :
getActiveUrl();

// return bool - Retourne true si on est en envirennement dév (se base sur le server name)
isLocalServer();

// return bool - Retourne true si l'IP request est dans les IP de développement
isDevIP();

// return mixed - Retourne une configuration (d'un fichier de config qu'on passe en paramètre)
config('config-file')['key']['key2'];
// on peut aussi faire ceci :
config('config-file.key.key2');

// return string - Retourne une translation d'un fichier de lang (d'un fichier de lang qu'on passe en paramètre)
lang('lang-file')['key']['key2'];
// on peut aussi faire ceci :
lang('lang-file.key.key2');

// return bool - Retourne true si l'internationalisation est activé
isMultilingual();

// return bool - Rtourne bool - si la lange locale est = à lang passé en paramètre
isLocale('lang');

// return string - Langue (soit celle par default, soit celle choisie par le visiteur) sous la forme 'fr'
getLocale();

// return string - Retourne une translation d'un fichier de trans (d'un fichier de trans qu'on passe en paramètre)
trans('subfolder.trans-file.key');
// on peut aussi faire ceci :
trans('subfolder/trans-file')['key'];
// la différence entre les fonction "lang" et "trans"
// est que "lang" est pour les translation du framework ("core")
// alors que "trans" est pour les translation de l'application ("app")

// return mixed - Obtient la valeur d'une variable d'environnement. Supporte les valeurs bool, empty et null.
env(string $key, $default=null);

// Retourner un exception si on est en dev
getException('File "'.$pathFileLog.'" not found');

// Retourner un exception si on est en dev, ou logger si on est en prod
getExceptionOrLog('File "'.$pathFileLog.'" not found');

// Retourner un exception si on est en dev, ou une erreur 404 si on est en prod
getExceptionOrGetError404('File "'.$pathFileLog.'" not found');

// Action erreur 404 - return error 404 HTTP
getError404();
```
