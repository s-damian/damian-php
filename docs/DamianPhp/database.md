
## * Sommaire *

* Conventions
    * Hériter du BaseModel
    * Constructeur dans Model
    * Nommage des colonnes et des propriétés
    * Méthodes magiques
    * Mutateurs
    * Relationships Many To Many
* L'instance
* Requetes SQL
    * Récupérer qu'une seule ligne - find(), findOrFail(), findBy(), findOrFailBy()
    * Récupérer plusieures lignes - findAll(), findAllBy()
    * WHERE, AND WHERE, OR WHERE, WHERE IN, OR WHERE IN
    * ORDER BY
    * LIMIT, OFFSET
    * Avec jointures (INNER JOIN, LEFT JOIN, RIGHT JOIN)
    * Pagination
    * Sélectionner uniquement certaines colonnes
    * Avec agrégation (COUNT, SUM, MAX)
    * Autres (when, rowCount)
    * INSERT (avec Active Record, ou en envoyant les données dans un array)
    * UPDATE (avec Active Record, ou en envoyant les données dans un array)
    * Assigner en masse (pour INSERT et UPDATE)
    * DELETE (avec Active Record, ou simple suppression)
* Dates (NOW)
* Getters
* Transactions
* Pour se connecter à une autre BDD que celle par defaut
* Relationships (relations)
    * Many To Many (plusieurs à plusieurs)
    * One To Many (un à plusieurs)
    * One To One (un à un)
* Divers
    * Dans Modèles, retourner la connexion de la BDD
    * Dans Modèles, faire des requêtes SQL sans l'ORM
    * Dans Modèles, hydrater des objets du Modèle
    * Récupérer le nom de la table




## Conventions

### Hériter du BaseModel

Il faut tout d'abord faire hériter vos Modèles du BaseModel de l'ORM. Exemple :
```php
<?php

namespace App\Models;

use DamianPhp\Database\BaseModel;

class Article extends BaseModel
{

}
```



### Constructeur dans Model

Si dans un de vos Modèles, vous mettez un constructeur, il faut appeler le parent.
Exemple :
```php
<?php

public function __construct()
{
    parent::__construct();
}
```



### Nommage des colonnes et des propriétés

Le nommage des colonnes en base de données, et le nommage des propriétés dans vos modèles, doit être au format snake_case.
Toutes les colonnes des tables de votre base de données doivent être déclaré en tant propriétés dans vos Modèles.



### Méthodes magiques

Pour les Setters et Getters, il faut utiliser le format CamelCase.
Exemple pour une colonne qui s'écrit "user_id" dans votre table :
```php
<?php

// Setter
$article->setUserId($value);

// Getter
echo $article->getUserId();
```



### Mutateurs

```php

Dans un Model, vous pouvez par exemple ajouter des mutateurs.
Ceci est utile lorsqu'on utilise un setter en méthode magique, ou lorsqu'onutilise la méthode fill() pour assigner en masse.
Il faut utiliser le format CamelCase, commencer par 'set', et finir par 'Attribute'.
Exemple avec un champs 'slug' :
<?php

/**
 * Mutateur du slug
 *
 * @param $value
 * @return string
 */
protected function setSlugAttribute(string $value = null): string
{
    if (empty($value)) {
        return Slug::create(Input::post('h1'));
    }

    return Slug::create(Input::post('slug'));
}
```



### Relationships Many To Many

Pour les relations Many To Many (plusieurs à plusieurs), il faut que les colonnes qui servent de clés finissent obligatoirement par "_id". 

Exemple avec des articles qui peuvent avoir plusieurs catégories et vice versa :

Il faut créer 3 tables :

* "articles" avec pour colonnes obligatoires : 'id'.
* "articles_categories" avec pour colonnes obligatoires : 'id'.
* "articles_categories_intermediate" avec pour colonnes obligatoires : 'article_id', 'category_id'




## L'instance

Pour instancier un Modèle, on peut faire ceci :
```php
<?php

use App\Models\Article;

$article = new Article();
```

Ou ceci :
```php
<?php

use App\Models\Article;

$article = Article::load();
```




## Requetes SQL (exemples avec un Controller ArticleController)

### Récupérer qu'une seule ligne - find(), findOrFail(), findBy(), findOrFailBy()

Pour récupérer qu'une seule ligne, il y a 2 méthodes :
* find() (Si un résultat -> ça retournera un objet hydraté du Model. Si pas de résultat -> ça retournera null)
* findOrFail() (Si un résultat -> ça retournera un objet hydraté du Model. Si pas de résultat -> ça retournera une erreur HTTP 404)

Exemples :
```php
<?php

// Récupérer un article WHERE slug
$article = Article::load()->where('slug', '=', 'article-1')->find();
// Résultat SQL : "SELECT * FROM articles WHERE slug = 'article-1' LIMIT 1"

// Récupérer un article WHERE slug ou une erreur HTTP 404
$article = Article::load()->where('slug', '=', 'article-1')->findOrFail();
// Résultat SQL : "SELECT * FROM articles WHERE slug = 'article-1' LIMIT 1"
```


Si on veut filtrer par son id, il est possible de mettre la valeur de l'id en paramètre :
```php
<?php

// Récupérer un article WHERE id
$article = Article::load()->find(1);
// Résultat SQL : "SELECT * FROM articles WHERE id = 1 LIMIT 1"

// Récupérer un article WHERE id ou une erreur HTTP 404
$article = Article::load()->findOrFail(1);
// Résultat SQL : "SELECT * FROM articles WHERE id = 1 LIMIT 1"
```


Il est aussi possible d'utiliser les méthodes magiques :
* findBy($param) (Si un résultat -> ça retournera un objet hydraté du Model. Si pas de résultat -> ça retournera null)
* findOrFailBy($param) (Si un résultat -> ça retournera un objet hydraté du Model. Si pas de résultat -> ça retournera une erreur HTTP 404)

Exemples :
```php
<?php

// Récupérer un article WHERE slug
$article = Article::load()->findBySlug('article-1');
// Résultat SQL : "SELECT * FROM articles WHERE slug = 'article-1' LIMIT 1"

// Récupérer un article WHERE slug ou une erreur HTTP 404
$article = Article::load()->findOrFailBySlug('article-1');
// Résultat SQL : "SELECT * FROM articles WHERE slug = 'article-1' LIMIT 1"
```
PS : On peut utiliser les méthodes magiques avec seulement un WHERE (et il faut utiliser le format CamelCase).



### Récupérer plusieures lignes - findAll(), findAllBy()

Pour récupérer plusieures lignes, il y a 1 méthodes :
* findAll() (Si un résultat -> ça etourne un tableaux d'objets hydratés du Model. Si pas de résultat -> ça etourne tableaux vide)

Exemple :
```php
<?php

// Récupérer une collection d'articles avec un WHERE
$articles = Article::load()->where('status', '=', 1)->findAll();
// Résultat SQL : "SELECT * FROM articles WHERE status = 1"
```


Il est aussi possible d'utiliser les méthodes magiques :
* findAllBy($param) (Si un résultat -> ça etourne un tableaux d'objets hydratés du Model. Si pas de résultat -> ça etourne tableaux vide)

Exemple :
```php
<?php

// Récupérer une collection d'articles avec un WHERE
$articles = Article::load()->findAllByStatus(1);
// Résultat SQL : "SELECT * FROM articles WHERE status = 1"
```
PS : On peut utiliser les méthodes magiques avec seulement un WHERE (et il faut utiliser le format CamelCase).



### WHERE, AND WHERE, OR WHERE, WHERE IN, AND WHERE IN, OR WHERE IN

Exemple avec un WHERE :
```php
<?php

$articles = Article::load()->where('status', '=', 1)->findAll();
// Résultat SQL : "SELECT * FROM articles WHERE status = 1"
```

Exemple avec un WHERE et avec un AND WHERE :
```php
<?php

$articles = Article::load()->where('status', '=', 1)->where('online', '=', 1)->findAll();
// Résultat SQL : "SELECT * FROM articles WHERE status = 1 AND online = 1"
```

Exemple avec un WHERE et avec un OR WHERE :
```php
<?php

$articles = Article::load()->where('status', '=', 1)->orWhere('online', '=', 1)->findAll();
// Résultat SQL : "SELECT * FROM articles WHERE status = 1 OR online = 1"
```

Exemple avec un WHERE IN :
```php
<?php

$articles = Article::load()->whereIn('id', [1, 2, 3])->findAll();
// Résultat SQL : "SELECT * FROM articles WHERE id IN (1, 2, 3)"
```

Exemple avec un WHERE IN et un AND WHERE IN :
```php
<?php

$articles = Article::load()->whereIn('status', [1, 2, 3])->whereIn('online', [1, 2])->findAll();
// Résultat SQL : "SELECT * FROM articles WHERE id IN (1, 2, 3) AND id IN (1, 2)"
```

Exemple avec un WHERE IN et un OR WHERE IN :
```php
<?php

$articles = Article::load()->whereIn('id', [1, 2, 3])->orWhereIn('id', [20, 21, 22])->findAll();
// Résultat SQL : "SELECT * FROM articles WHERE id IN (1, 2, 3) OR id IN (20, 21, 22)"
```



### ORDER BY

```php
<?php

$articles = Article::load()->where('status', '=', 1)->orderBy('title', 'ASC')->findAll();
// Résultat SQL : "SELECT * FROM articles WHERE status = 1 ORDER BY 'title' ASC"


$articles = Article::load()->where('status', '=', 1)->orderBy('status', 'ASC')->orderBy('id', 'DESC')->findAll();
// SQL result: "SELECT * FROM articles WHERE status = 1 ORDER BY 'status' ASC, 'id', DESC"
```



### LIMIT, OFFSET

```php
<?php

$articles = Article::load()->where('status', '=', 1)->limit(5)->offset(2)->findAll();
// Résultat SQL : "SELECT * FROM articles WHERE status = 1 LIMIT 5 OFFSET 2"
```



### Avec jointures

INNER JOIN :
```php
<?php

// Par exemple, récupérer tous les articles qui sont joints à une catégorie WHERE son id avec un INNER JOIN
$articlesRelatedToCategory = Article::load()
    ->join(
        ArticleCategory::getTableIntermediateRelatedArticles(),
        Article::getTable().'.id', '=', ArticleCategory::getTableIntermediateRelatedArticles().'.article_id'
    )
    ->where(ArticleCategory::getTableIntermediateRelatedArticles().'.category_id', '=', 2)
    ->findAll();
// Résultat SQL :
// "SELECT * FROM articles
// INNER JOIN articles_categories_intermediate 
//   ON articles.id = articles_categories_intermediate.article_id
// WHERE articles_categories_intermediate.category_id = 2"
```


LEFT JOIN :
```php
<?php

// Par exemple, récupérer tout les articles qui sont joints à une catégorie WHERE son id avec un LEFT JOIN
$articlesRelatedToCategory = Article::load()
    ->leftJoin(
        ArticleCategory::getTableIntermediateRelatedArticles(),
        Article::getTable().'.id', '=', ArticleCategory::getTableIntermediateRelatedArticles().'.article_id'
    )
    ->where(ArticleCategory::getTableIntermediateRelatedArticles().'.category_id', '=', 2)
    ->findAll();
// Résultat SQL :
// "SELECT * FROM articles
// LEFT JOIN articles_categories_intermediate 
//   ON articles.id = articles_categories_intermediate.article_id
// WHERE articles_categories_intermediate.category_id = 2"
```


RIGHT JOIN :
```php
<?php

// Par exemple, récupérer tout les articles qui sont joints à une catégorie WHERE son id avec un RIGHT JOIN
$articlesRelatedToCategory = Article::load()
    ->rightJoin(
        ArticleCategory::getTableIntermediateRelatedArticles(),
        Article::getTable().'.id', '=', ArticleCategory::getTableIntermediateRelatedArticles().'.article_id'
    )
    ->where(ArticleCategory::getTableIntermediateRelatedArticles().'.category_id', '=', 2)
    ->findAll();
// Résultat SQL :
// "SELECT * FROM articles
// RIGHT JOIN articles_categories_intermediate 
//   ON articles.id = articles_categories_intermediate.article_id
// WHERE articles_categories_intermediate.category_id = 2"
```



### Pagination

Pour paginer un listage d'éléments, faut faire comme ceci :
```php
<?php

$article = new Article();

$articles = $article->where('status', '=', 1)->paginate(20);
// Résultats SQL :
// SELECT COUNT(id) AS nb FROM articles WHERE status = 1
// Et :
// SELECT * FROM articles WHERE status = 1 LIMIT 20 OFFSET ? 

var_dump($article->getTotal());  // return int - Nombre d'articles paginés

$pagination = $article->getPagination();

foreach ($articles as $article) {
    echo $article->title;
}

echo $pagination->render(); // return string
echo $pagination->perPageForm(); // return string
```
Le paramètre de la méthode paginate() est ut est optionnel.
Ceci est utilise pour choisir le nombre d'élément à afficher par page.
Est à 10 par défaut.



### Sélectionner uniquement certaines colonnes

Il y a ces 3 syntaxes qui fonctionnent :
```php
<?php

Article::load()->select('title, description, content')->where('id', '=', 1)->find();

Article::load()->select('title', 'description', 'content')->where('id', '=', 1)->find();

Article::load()->select(['title', 'description', 'content'])->where('id', '=', 1)->find();
```



### Avec agrégation

COUNT :
```php
<?php

$countArticles = Article::load()->count('id');
// return int - Résultat SQL : "SELECT COUNT(id) AS nb FROM articles"
// PS : Le paramètres 'id' n'est pas obligatoire. Est '*' par défaut.
```

Si vous voulez faire un COUNT avec uniquement un WHERE, vous pouvez utiliser les méthodes magiques :
```php
<?php

$countArticlesByStatus =  Article::load()->countByStatus(1);
// return int - Résultat SQL : "SELECT COUNT(*) AS nb FROM articles WHERE status = 1"
// PS : En 2ème paramètres de "countByStatus" on peut préciser la colonne en ajoutant un 2ème paramètres. Est '*' par défaut.
```


SUM :
```php
<?php

$sumIdArticles = Article::load()->sum('id');
// return int - Résultat SQL : "SELECT SUM(id) AS nb FROM articles"
```


MAX :
```php
<?php

$maxIdArticles = Article::load()->max('id');
// return int - Résultat SQL : "SELECT MAX(id) AS nb FROM articles"
```



### Autres

when - Pour éventuellement ajouter condition(s) à la requete SQL si certaine(s) condition(s) sont sont === à true :
```php
<?php

$condition = true;
$articles = Article::load()
    ->select('title, description, content')
    ->where('id', '!=', 1)
    ->when($condition === true, function ($query) {
        return $query->where('status', '=', 1);
    })
    ->findAll();
// Si $condition = true - Résultat SQL : "SELECT title, description, content FROM articles WHERE id != 1 AND status = 1"
// Si $condition = false - Résultat SQL : "SELECT title, description, content FROM articles WHERE id != 1"
```

rowCount - Pour éventuellement récupérer nombre de lignes affectées :
```php
<?php

$article = new Article();
$articles = $article->runRowCount(true)->findAll();
var_dump($article->getRowCount());
// return int - Nombre de lignes affectées
```



### INSERT

Avec Active Record Patern :
```php
<?php

$article = new Article();
$article->setStatus(2);
$article->setH1('Article 12');
$article->setDescription('Description Article 12');
$article->setContent('Content Article 12');
$article->setTitle('Title Article 12');
$article->setSlug('article-12');
$article->save();
// Résultat SQL :
// "INSERT INTO articles (status, h1, description, content, title, slug)
//  VALUES (1, 'Article 12', 'Description Article 12', 'Content Article 12', 'Title Article 12', 'article-12')"
```

Ou en envoyant les données dans un array :
```php
<?php

Article::load()->create([
    'status' => 2,
    'h1' => 'Article 12',
    'description' => 'Description Article 12',
    'content' => 'Content Article 12',
    'title' => 'Title Article 12',
    'slug' => 'article-12',
]);
// Résultat SQL :
// "INSERT INTO articles (status, h1, description, content, title, slug)
//  VALUES (1, 'Article 12', 'Description Article 12', 'Content Article 12', 'Title Article 12', 'article-12')"

// _Récupérer dernier id inséré par auto-incrémentation
$article->getLastInsertId();
```



### UPDATE

Avec Active Record Patern :
```php
<?php

$article = Article::load()->findById(1);
$article->setStatus(2);
$article->setH1('Article 1');
$article->setDescription('Description Article 1');
$article->setContent('Content Article 1');
$article->setTitle('Title Article 1');
$article->setSlug('article-1');
$article->save();
// Résultats SQL :
// "SELECT * FROM articles WHERE id = 1 LIMIT 1"
// Et :
// "UPDATE articles SET
//  status = 1, h1 = 'Article 1', description = 'Description Article 1', content = 'Content Article 1', title = 'Title Article 1', slug = 'article-1'
//  WHERE id = 1 LIMIT 1"
```

Ou en envoyant les données dans un array :
```php
<?php

Article::load()
    ->where('id', '=', 1)
    ->limit(1)
    ->update([
        'status' => 2,
        'h1' => 'Article 1',
        'description' => 'Description Article 1',
        'content' => 'Content Article 1',
        'title' => 'Title Article 1',
        'slug' => 'article-1',
    ]);
// Résultat SQL :
// "UPDATE articles SET
//  status = 1, h1 = 'Article 1', description = 'Description Article 1', content = 'Content Article 1', title = 'Title Article 1', slug = 'article-1'
//  WHERE id = 1 LIMIT 1"
```



### Assigner en masse (pour INSERT et UPDATE)

Dans le model faut d'abord définir les colonnes qui sont assignables en masse :
```php
<?php

/**
 * Les attributs qui sont assignables en masse.
 *
 * @var array
 */
protected $fillable = [
    'status',
    'h1',
    'description',
    'content',
    'title',
    'slug',
];


```

Et ensuite on peut faire un save en assignant en masse :
```php
<?php

$article = Article::load()->findById(1);
$article->fill(Request::getPost()->all());
$article->save();
// Résultats SQL :
// "SELECT * FROM articles WHERE id = 1 LIMIT 1"
// Et :
// "UPDATE articles SET
//  status = 1, h1 = 'Article 1', description = 'Description Article 1', content = 'Content Article 1', title = 'Title Article 1', slug = 'article-1'
//  WHERE id = 1 LIMIT 1"
```



### DELETE

Avec Active Record Patern :
```php
<?php

$article = Article::load()->findById(13);
$article->delete();
// Résultats SQL :
// "SELECT * FROM articles WHERE id = 13 LIMIT 1"
// Et :
// "DELETE FROM articles WHERE id = 13 LIMIT 1"
```

Ou simple suppression :
```php
<?php

Article::load()->where('id', '=', 13)->limit(1)->delete();
// Résultat SQL :
// "DELETE FROM articles WHERE id = 13 LIMIT 1"
```




## Dates

Retourner date actuelle :
```php
<?php

$article = new Article();
$article->getNow();
```




## Getters

Il est possible d'utiliser des getters, comme ceci par exemple :
```php
<?php

$article = Article::load()->findById(13);
var_dump($article->getH1());
```
Il faut utiliser le format CamelCase.




## Transactions

```php
<?php

$article = new Article();

// Démarrer une transaction
$article->beginTransaction();

// Valider une transaction
$article->validTransaction();

// Annuler une transaction
$article->cancelTransaction();
```




## Pour se connecter à une autre BDD que celle par defaut

Si vous souhaitez vous connecter avec d'autres identifiants de ceux de votre configuration,
dans le constructeur du Model pour lequel vous souhaitez changer d'identifiants vous devez utiliser cette syntaxe :
```php
<?php
      
/**
 * An Model constructor.
 */
public function __construct()
{
    // Il faut d'abord appeler le constructeur
    parent::__construct();

    $this->setIdConnexion(['host'=>'value', 'database'=>'value', 'username'=>'value', 'password'=>'value']);
}
```


Si vous souhaitez vous connecter à un autre connecteur de celui de votre configuration,
dans le constructeur du Model pour lequel vous souhaitez changer de connecteur vous devez utiliser cette syntaxe :
```php
<?php

/**
 * An Model constructor.
 */
public function __construct()
{
    // Il faut d'abord appeler le constructeur
    parent::__construct();

    $this->setConnector('mysql');   // Supported: 'mysql' (d'autres SGBD seront supportés prochainement)
}
```




## Relationships (relations)

### Many To Many (plusieurs à plusieurs)

Prenons pour exemple des articles qui peuvent avoir plusieurs catégories et vice versa.

Nous allons créer 3 tables :
* "articles" avec pour collonnes : 'id', 'title', 'content', 'user_id'
* "articles_categories" avec pour collonnes : 'id', 'name', 'slug'
* "articles_categories_intermediate" avec pour collonnes : 'article_id', 'category_id'

Il faut ensuite ajouter cette méthode dans le Modèle Article :
```php
<?php

/**
 * Des articles peuvent avoir plusieurs catégories
 *
 * @return array - Toutes les catégories reliées à un article WHERE son id
 */
public function articleCategories()
{
    // 'article_id' et 'category_id' sont les foreign_key de la table pivot (table "articles_categories_intermediate")
    // 'article_id' : colonne dans table pivot qui fait référence à "model_id"
    // 'category_id' : colonne dans table pivot qui fait référence à "model-related_id"
    return $this->belongsToMany(
        ArticleCategory::class,
        'articles_categories_intermediate',
        'article_id',
        'category_id'
    );     
}
```


Dans le Controller ArticleController on peut ensuite faire ceci :
```php
<?php

// Récupérer l'article WHERE son id :
$article = Article::load()->findById(2);
// Résultat SQL : "SELECT * FROM articles WHERE id = 2 LIMIT 1"

// Récupérer toutes les catégories jointes à cette article :
$articleCategories = $article->articleCategories();
// Résultat SQL :
// SELECT articles_categories.* FROM articles_categories
// INNER JOIN articles_categories_intermediate
//   ON articles_categories.id = articles_categories_intermediate.category_id
// WHERE articles_categories_intermediate.article_id = 2
```
Si on veut faire l'inverse, c'est exactement le même principe.



### One To Many (un à plusieurs)

Prenons pour exemple des utilisateurs qui peuvent avoir plusieurs articles reliés.

Nous allons créer 2 tables :
* "articles" avec pour collonnes : 'id', 'title', 'content', 'user_id'
* "users" avec pour collonnes : 'id', 'email', 'username', 'password'

Il faut ensuite ajouter cette méthode dans le Modèle User :
```php
<?php

/**
 * Des utilisateurs peuvent avoir plusieurs articles
 *
 * @return array - Tout les articles reliés à un user WHERE foreign_key de la table related
 */
public function articles()
{
    // 'user_id' est le foreign_key de la table related (table "articles")
    return $this->hasMany(Article::class, 'user_id');
}
```


Dans le Controller UserController on peut ensuite faire ceci :
```php
<?php

// Récupérer l'user WHERE son id :
$user = User::load()->findById(2);
// Résultat SQL : "SELECT * FROM users WHERE id = 2 LIMIT 1"

// Récupérer tous les articles reliés à cette user
$articlesRelatedToUser = $user->articles();
// Résultat SQL : "SELECT articles.* FROM articles WHERE articles.user_id = 2"
```



### One To One (un à un) - One To Many Inverse (un à plusieurs inversé)

Prenons pour exemple des articles qui peuvent avoir qu'un seul user relié.

Nous allons créer 2 tables :
* "articles" avec pour collonnes : 'id', 'title', 'content', 'user_id'
* "users" avec pour collonnes : 'id', 'email', 'username', 'password'

Il faut ensuite ajouter cette méthode dans le Modèle Article :
```php
<?php

/**
 * Des articles peuvent avoir un user
 *
 * @return mixed - L'user relié à un article WHERE foreign_key
 */
public function user()
{
    // 'user_id' est le foreign_key de la table "articles"
    return $this->hasOne(User::class, 'user_id');
}
```


Dans le Controller ArticleController on peut ensuite faire ceci :
```php
<?php

// Récupérer l'article WHERE son id :
$article = Article::load()->findById(1);
// Résultat SQL : "SELECT * FROM articles WHERE id = 1 LIMIT 1"

// Prenons pour exemple que la colonne 'user_id' de l'article a pour valeur "2"
// Récupérer l'user relié à cette article :
$userRelatedToArticle = $article->user();
// Résultat SQL : SELECT users.* FROM users WHERE users.id = 2 LIMIT 1
```




## Divers

### Dans Modèles, retourner la connexion de la BDD

```php
<?php

$this->getConnection();
```



### Dans Modèles, faire des requêtes SQL sans l'ORM

Exemple avec array associatif et avec des emplacements nommés :
```php
<?php

$status = 1;
$online = 1;

$sql = "SELECT * FROM article WHERE status = :status AND online = :online";
$this->query($sql, [':status'=>$status, ':online'=>$online]);
```


Exemple avec array numéroté et avec des marqueurs de positionnement :
```php
<?php

$status = 1;
$online = 1;

$sql = "SELECT * FROM article WHERE status = ? AND online = ?";
$this->query($sql, [$status, $online]);
```



### Dans Modèles, hydrater des objets du Modèle

Hydrater plusieurs objets du Modèle avec le résultat d'une request SQL :
```php
<?php

$query = $this->query($sql);

$hydratedObjects = $this->getHydratedObjects($query);
```

Hydrater un seul objet du Modèle avec le résultat d'une request SQL :
```php
<?php

$query = $this->query($sql);

$result = $query->fetch();

$query->closeCursor();

return $this->getHydratedObject($result);
```



### Récupérer le nom de la table

Récupérer le nom de la table avec préfixe :
```php
<?php

$article = new Article();
$article->getDbTable();
