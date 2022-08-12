# use DamianPhp\Support\Facades\Cache;

```php
<?php

// afficher ou créer le chache
if (!$parameter = Cache::get('name_file', 10080)) {
    $parameter = 'Valeur';

    Cache::put('name_file', $parameter);
}
// 10080 : durrée de vie en min. OPTIONAL

// return string - Récupérer valeur du fichier
Cache::get('name_file', 10080);

// Récupérer valeur du fichier sérialisé sous forme d'objet
Cache::getToObject('name_file', 10080);

// return array - Récupérer valeur du fichier sérialisé sous forme d'array
Cache::getToArray('name_file', 10080);

// Récupérer valeur du fichier sous forme d'objet, ou le créer avec valeur du callable si n'existe pas
$parameter = Cache::remember('user/parameters', 10080, function() {
    return Parameter::load()->find();
});

// return bool - True si fichier existe
Cache::has('name_file');

// Supprimer un fichier du cache
Cache::destroy('nom_du_fichier_a_supprimer');

// Supprimer tout le dossier cache
Cache::clear('path_optional');


// Exemple concré
$parameter = Cache::remember(getLocale().'/parameter/parameters', 10080*4, function () {
    return Parameter::load()->find();
});  

```
