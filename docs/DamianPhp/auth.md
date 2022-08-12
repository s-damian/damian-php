## * Sommaire *

* Auth
* IsConnected




# use DamianPhp\Auth\Auth;

```php
<?php

$auth = new Auth(YourUserModel::class);
$auth->remember('your_remember_cookie_name')->connect('YourAuthSessionName', [
    'id' => (int) $requete->id,
    'role' => (int) $requete->role,
    'username' => $this->username,
    'first_name' => $requete->first_name,
]);
```

```->remember('...')``` est OPTIONNEL. (Est utile uniquement si on laisse une option "Se souvenir de moi" au login).
Dans le array de ```->connect```, la key et la valeur de 'id' sont obligatoires.

Obligatoires pour chaque création d'espace membres :
- Dans la table "users" dans la BDD, il doit y avoir : une colonne "remember_token" et une colonne "date_last_connexion".
- Dans la vue de login où l'user doit s'identifier, si on met une case à cocher, elle doit toujours avoir en name "remember" (```name="remember"```).




# use DamianPhp\Auth\IsConnected;

```php
<?php

$isConnected = new IsConnected(YourUserModel::class);

$optionalValuesIntForRegenerateSession = ['id', 'role'];

$isConnected->session('YourAuthSessionName', ['id', 'role', 'username', 'first_name'], $optionalValuesIntForRegenerateSession)
            ->cookie('your_remember_cookie_name')
            ->urlToredirectIfFalse('url_logout');

if ($isConnected->isLogged()) {
    $isConnected->exit()
}
```

```->cookie('...')``` est optionel (est requis uniquement si on laisse une option "Se souvenir de moi" au login).
Dans le 2è paramètre (array numéroté) de ```->session('...')```, il faut mettre en valeur les keys qu'on passe dans ```Auth::...connect('...', ['key' => $value...])```.
