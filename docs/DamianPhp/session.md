# use DamianPhp\Support\Facades\Session;

Les nom de session qui sont reservés :
- '_flash' : utilisé pour les alertes flash.
- '_token' : utilisé pour la sécurité (contre ataques CSRF).
- '_url' : utilisé pour l'URL courante (utile pour rediriger vers l'URL précédente par exemple).


```php
<?php

// Démarrer session
Session::start();

// Créer/modifier une session
Session::put('name', 'valeur');

// return array - Toutes les sessions
Session::all();

// return array - Les keys des sessions 
Session::keys();

// return int - Le nombre de sessions
Session::count();

// Supprimer une session spécifique
Session::destroy('name');

// Supprimer toutes les variables de session
Session::clear('name');

// return bool - Vérifier si une session existe
if (Session::has('nom_session')) {
    // Success
} else {
    // Error
}

// return mixed - Retourner la valeur de la session
Session::get('name')['key_optional'];


Session::regenerateId();
```




# use DamianPhp\Support\Facades\Flash;

```php
<?php

// Afficher un message flash
echo Flash::get('key');

// Créer un message flash de validation
Flash::setOk('Article publié !');

// Créer un message flash d'erreur
Flash::setError('Erreur !');

// Afficher un message flash de confirmation ou d'erreur (à mettre par exemple dans le footer pour que les messages flash puissent être utilisés dans tout le site web)
echo Flash::getResponse();
```
