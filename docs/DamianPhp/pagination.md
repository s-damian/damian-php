# use DamianPhp\Pagination\Pagination;

## Méthodes

| Return type | Method                           | Description                                                               |
| ----------- | -------------------------------- | ------------------------------------------------------------------------- |
| void        | __construct(array $options = []) | Constructor.                                                              |
| void        | paginate(int $count)             | (to use in the Controller) Activate the pagination.                       |
| null or int | getLimit()                       | (to use in the Controller) LIMIT: Number of items to retrieve.            |
| null or int | getOffset()                      | (to use in the Controller) OFFSET: From where you start the LIMIT.        |
| int         | getCount()                       | Determine the total number of matching items in the data store.           |
| int         | getCountOnCurrentPage()          | Determine the total number of matching item on the current page.          |
| int         | getFrom()                        | Get the result number of the first item in the results.                   |
| int         | getTo()                          | Get the result number of the last item in the results.                    |
| int         | getCurrentPage()                 | Get the current page number.                                              |
| int         | getNbPages()                     | Get the page number of the last available page (number of pages).         |
| bool        | hasPages()                       | Determine if there are enough items to split into multiple pages.         |
| bool        | hasMorePages()                   | Determine if there are more items in the data store.                      |
| bool        | isFirstPage()                    | Determine if the paginator is on the first page.                          |
| bool        | isLastPage()                     | Determine if the paginator is on the last page.                           |
| string      | render()                         | (to use in the View) Make the rendering of the pagination in HTML format. |
| string      | perPage(array $options = [])     | (to use in the view) Make the rendering of the per page in HTML format.   |




## Exemples

### Exemple simple

```php
<?php

use DamianPhpPagination\Pagination;

$pagination = new Pagination();

$pagination->paginate($countElements);

$limit = $pagination->getLimit();
$offset = $pagination->getOffset();

// Ici votre listage d'éléments avec une boucle

echo $pagination->render();
echo $pagination->perPage();
```



### Exemple avec des requetes SQL

```php
<?php

use DamianPhpPagination\Pagination;

// Récupérer nombre d'elements d'une table
function countElements() {
    $sql = "SELECT COUNT(*) AS nb FROM table";
    $query = db()->query($sql);
    $result = $query->fetch();
    
    return $result->nb;
}

// Récupérer les éléments
function findElements($limit, $offset) {
    $sql = "SELECT * FROM table LIMIT ? OFFSET ?";
    $query = db()->prepare($sql);
    $query->bindValue(1, $limit, PDO::PARAM_INT);
    $query->bindValue(2, $offset, PDO::PARAM_INT);
    $query->execute();

    return $query;
}

// Création d'un objet Pagination
$pagination = new Pagination();

// Paginer
$pagination->paginate(countElements());

$limit = $pagination->getLimit();
$offset = $pagination->getOffset();

// Afficher les éléments un par un qui sont récupérés de la BDD
foreach (findElements($limit, $offset) as $article) {
    echo htmlspecialchars($article->field);
}

// Afficher la Pagination
echo $pagination->render();
// Afficher un "per page" (utile pour choisir nombre d'éléments à afficher par page)
echo $pagination->perPage();
```
La fonction "db()" doit retourner le résultat de la connexion à une base de donnée (le résultat d'une instance de PDO par exemple).
Mais vous n'êtes pas obligé de créer un fonction "db()", vous pouvez utiliser cette librairie avec un ORM par exemple.



### Exemple avec une liste de fichiers d'un répertoire

```php
<?php

use DamianPhpPagination\Pagination;

$scandir = scandir('votre_dossier_d_upload');

$listFilesFromPath = [];
$count = 0;
foreach ($scandir as $f) {
    if ($f != '.' && $f != '..') {
        $listFilesFromPath[] = $f;
        $count++;
    }
}

// Création d'un objet Pagination
$pagination = new Pagination();

// Paginer
$pagination->paginate($count);

// Liste
$files = array_slice($listFilesFromPath, $pagination->getOffset(), $pagination->getLimit());

// Afficher les fichiers un par un
foreach ($files as $file) {
    echo $file;
}

// Afficher la Pagination
echo $pagination->render();
// Afficher un "per page" (utile pour choisir nombre d'éléments à afficher par page)
echo $pagination->perPage();
```



### Ajouter argument(s) à l'instance

Lors de la création de l'objet Pagination, vous pouvez passer un tableaux d'options au constructeur de l'instance :
```php
<?php

// Nombre d'éléments par page
$pagination = new Pagination(['pp'=>20]);
// Est à 15 par défaut

// Nombre de liens aux cotés de la page courante
$pagination = new Pagination(['number_links'=>3]);
// Est à 5 par défaut

// The otpions of the select TAG to be possibly generated with perPage()
$pagination = new Pagination(['options_select'=>[5, 10, 50, 100, 500, 'all']]);
// La valeur de 'options_select' doit être un tableaux.
// Seul des nombres entiers et 'all' sont autorisés.
// La valeur est [15, 30, 50, 100, 200, 300] par défaut.

// Pour changer le style CSS de la pagination (mettre une autre class CSS que celle par défaut)
$pagination = new Pagination(['css_class_p'=>'name-css-class-of-pagintion']);
// La class CSS se nomme par défaut "pagination"

// Pour changer le style CSS du lien actif (page courante)
$pagination = new Pagination(['css_class_link_active'=>'name-css-class-of-active-link']);
// La class CSS se nomme par défaut "active"

// Pour changer le style CSS du par page (select) (mettre un autre id CSS que celui par défaut)
$pagination = new Pagination(['css_id_pp'=>'name-css-id-of-per-page']);
// L'ID CSS se nomme par défaut "per-page"
```



### Exemples d'utilisation des méthodes de rendu

Pour afficher la pagination :
```php
<?php

// return string
echo $pagination->render();

// Si il y a déjà des paramètres envoyés en GET, on a parfois envie des les "cumuler" avec les liens de la pagination.
// Voici la solution :

// Pour "cumuler" un GET aux liens de Pagination
echo $pagination->render('get');

// Pour "cumuler" des GET aux liens de Pagination
echo $pagination->render(['get1', 'get2']);
```


Pour afficher un select pour que le visiteur puisse avoir le choix du nombre d'éléments à afficher par page, il faut ajouter ceci :
```php
<?php

// return string
echo $pagination->perPage();

// En paramètre de cette méthode, on peut préciser l'action du formulaire. Exemple :
echo $pagination->perPage('action_url');
// Si vous ne le faite pas, l'action prendra par défaut comme valeur $_SERVER['REQUEST_URI'].
```


Pour afficher le nombre total d'éléments sur lesquels on pagine :
```php
<?php

// return int
echo $pagination->getCount();
```


Pour afficher le nombre d'éléments de la page en cours :
```php
<?php

// return int
echo $pagination->getCountOnCurrentPage();
```


Pour retourner l'indexation du premier élément et l'indexation du dernier élément sur la page en cours (utile pour par exemple afficher : élément "nombre_X" à "nombre_X" sur cette page) :
```php
<?php

// return int - L'indexation du premier élément sur la page en cours
echo $pagination->getFrom();

// return int - L'indexation du dernier élément sur la page en cours
echo $pagination->getTo();
```


Pour afficher la page en cours :
```php
<?php

// return int
echo $pagination->getCurrentPage();
```


Pour afficher nombre de pages :
```php
<?php

// return int
echo $pagination->getNbPages();
```


Pour afficher le nombre d'éléments qui sont affichés par page :
```php
<?php

// return int
echo $pagination->getPerPage();
```


Retourne bool - True si il reste des pages après celle en cours :
```php
<?php

// return bool
$pagination->hasMorePages();
```
