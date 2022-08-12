
# Benchmark - Damian PHP Framework vs Laravel Framework

## Web Server

These tests were done on an XPS 13 which has these characteristics: 16 GB of Memory onboard / 11th Gen Intel processors / 512 GB of SSD.

LEMP Server: Ubuntu 20.04 / Nginx 1.22 / PHP 8.1 / MariaDB 10.7.

## INSERT multiple rows one by one

In this example, we will insert 1000 rows one by one.

Result: Damian PHP Framework is almost 2 times more efficient than Laravel Framework.

### With Laravel Framework:
```php
<?php

$start = hrtime(true);

for ($i=1; $i <= 1000; $i++) {
    $article = new Article();
    $article->content = 'Article '.$i;
    $article->description = 'Article '.$i;
    $article->h1 = 'Article '.$i;
    $article->is_indexable = 1;
    $article->content = 'Article '.$i;
    $article->slug = '-article-'.$i;
    $article->status = 1;
    $article->summary = 'Article '.$i;
    $article->title = 'Article '.$i;
    $article->image = '';
    $article->user_id_created_at = 1;
    $article->user_id_updated_at = 1;
    $article->created_at = now();
    $article->updated_at = now();
    $article->published_at = now();
    $article->save();
}

$end = hrtime(true);
$diff = $end - $start;
$diff_in_ms = $diff/1e+6 ; // nanoseconds to milliseconds

var_dump( $diff_in_ms ); die; // result: about 1000 milliseconds
```

### With Damian PHP Framework:
```php
<?php

$start = hrtime(true);

for ($i=1; $i <= 1000; $i++) {
    $article = new Article();
    $article->setContent('Article '.$i);
    $article->setDescription('Article '.$i);
    $article->setH1('Article '.$i);
    $article->setIsIndexable(1);
    $article->setContent('Article '.$i);
    $article->setSlug('-article-'.$i);
    $article->setStatus(1);
    $article->setSummary('Article '.$i);
    $article->setTitle('Article '.$i);
    $article->setImage('');
    $article->setUserIdCreatedAt(1);
    $article->setUserIdUpdatedAt(1);
    $article->setCreatedAt($article->getNow());
    $article->setUpdatedAt($article->getNow());
    $article->setPublishedAt($article->getNow());
    $article->save();
}

$end = hrtime(true);
$diff = $end - $start;
$diff_in_ms = $diff/1e+6 ; // nanoseconds to milliseconds

var_dump( $diff_in_ms ); die; // result: about 580 milliseconds
```


## SELECT multiple rows in a single SQL query

In this example, we will select 100 000 rows in a single SQL query.

Result: Damian PHP Framework performs about 25% higher than Laravel Framework.

### With Laravel Framework:
```php
<?php

$start = hrtime(true);

Article::limit(100000)->get();

$end = hrtime(true);
$diff = $end - $start;
$diff_in_ms = $diff/1e+6 ; // result: about 750 milliseconds

var_dump( $diff_in_ms ); die;
```

### With Damian PHP Framework:
```php
<?php

$start = hrtime(true);

Article::load()->limit(100000)->findAll();

$end = hrtime(true);
$diff = $end - $start;
$diff_in_ms = $diff/1e+6 ; //nanoseconds to milliseconds

var_dump( $diff_in_ms ); die; // result: about 550 milliseconds
```
