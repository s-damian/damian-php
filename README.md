<p align="center">
<a href="https://github.com/s-damian/damian-php">
<img src="https://raw.githubusercontent.com/s-damian/medias/main/damian-php-logo.png" width="400">
</a>
</p>

<p align="center">
<a href="https://packagist.org/packages/s-damian/damian-php"><img src="https://img.shields.io/packagist/v/s-damian/damian-php" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/s-damian/damian-php"><img src="https://img.shields.io/packagist/l/s-damian/damian-php" alt="License"></a>
</p>


# Damian PHP Framework - Skeleton

> A powerful PHP Framework in PHP 8.1 - Beautiful code & Elegant syntax

This library is developed by [Stephen Damian](https://www.linkedin.com/in/stephen-damian/) [![Stephen Damian - LinkedIn](https://raw.githubusercontent.com/s-damian/medias/main/favicon-linkedin.png)](https://www.linkedin.com/in/stephen-damian/)

Here you have the source codes of the skeleton.


### Kernel source code

The kernel source codes for this Framework are in this package:

[Damian PHP Framework - Kernel - [damian-php-fw]](https://github.com/s-damian/damian-php-fw)


## Getting Started

### Requirements

* PHP >= 8.1

### Ccreate a new project

* You can create a new project via the **composer create-project** command:
```
composer create-project s-damian/damian-php example-app-name
```

### Configuration

* Create your **.env** file:

```
cd /your-path/example-app-name

cp .env.example .env
```

* You have to configure the **.env** file.

### Configuration - HTTP Server

* You have to configure your web server (Linux / Nginx or Apache / MySQL or PostgreSQL / PHP).

You have an example Nginx Vhost configuration in **/docs/nginx/vhost-example.conf** file.


### After configuring your HTTP server (Nginx), you can run these demo URLs

* http://www.your-domain.com
* http://www.your-domain.com/contact
* http://www.your-domain.com/blog
* http://www.your-domain.com/blog/slug-1
* http://www.your-domain.com/callable-example
* http://www.your-domain.com/sitemap


## Documentation

* The documentation for this Framework is in **/docs/DamianPhp** folder.


## Syntax examples

### Routing

An example of a route listing:
```php
<?php

Router::group(['namespace' => 'Front\\', 'prefix' => 'website'], function () {
    Router::group(['prefix' => '/blog'], function () {
        Router::get(
            '',
            'Article@index',
            ['name' => 'article_index']
        );
        Router::get(
            '/{slug}',
            'Article@show',
            ['name' => 'article_show']
        );
    });
});
```

Retrieve a URL with the name of a route:
```php

<?php echo route('article_show', ['slug' => $article->slug]); ?>
```

### ORM (compatible with MySQL and PostgreSQL)

#### Active Record Pattern

Example to insert an article:
```php
<?php

$article = new Article();
$article->setTitle('Article 1');
$article->setDescription('Description');
$article->setContent('Content');
$article->setSlug('slug-1');
$article->save();
```

Example to update an article (using the **fill** magic method):
```php
<?php

$article = Article::load()->findOrFail($id);
$article->fill(Request::getPost()->all());
$article->save();
```

#### Fetch multiple rows

Example using the **when** magic method:

```php
<?php

$articles = Article::load()
    ->select('title, description, content')
    ->where('id', '!=', 1)
    ->when((int) Input::get('status') === 1, function ($query) {
        return $query->where('status', '=', 1);
    })
    ->findAll();
```

#### ORM with Pagination

To paginate an item listing:
```php
<?php

$article = new Article();

$articles = $article->where('status', '=', 1)->paginate(20);

$pagination = $article->getPagination();

foreach ($articles as $article) {
    echo $article->title;
}

echo $pagination->render();
echo $pagination->perPageForm();
```

### Pagination

```php
<?php

$pagination = new Pagination();

$pagination->paginate($countElements);

$limit = $pagination->getLimit();
$offset = $pagination->getOffset();

// Here your list of items with a loop.

echo $pagination->render();
echo $pagination->perPageForm();
```

### Validation

Validation example (you can do method injection):
```php
<?php

public function update(Validator $validator, int $id)
{
    $validator->rules([ // Add your rules in the array.
        'title' => ['max' => 190, 'required' => true],
        'description' => ['max' => 190, 'required' => true],
        'content' => ['required' => true],
    ]);

    if ($validator->isValid()) {
        // Success
    } else {
        // Error
        $validator->getErrorsHtml();
    }
}
```

You can add custom validation rules. Example:
```php
<?php

Validator::extend('strictly_equal', function ($input_name, $input_value, $parameters) {
    return (string) $input_value === (string) $parameters;
});
```
