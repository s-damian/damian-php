<?php

namespace App\Models;

use DamianPhp\Database\BaseModel;

/**
 * Example of a Model of articles.
 */
class Article extends BaseModel
{
    /*
    |--------------------------------------------------------------------------
    | Columns:
    |--------------------------------------------------------------------------
    */

    /**
     * Type int(11) - Attributs usigned - Null no - Index primary key - Extra auto_increment.
     */
    public int $id;

    /**
     * Type varchar(255) - Null no.
     */
    public string $title;

    /**
     * Type varchar(255) - Null no.
     */
    public string $description;

    /**
     * Type longtext - Null no.
     */
    public string $content;

    /**
     * Type varchar(255) - Null no - Index unique key.
     */
    public string $slug;

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = [
        'title',
        'description',
        'content',
        'slug',
    ];

    public static function getFakeArticles(): array
    {
        $articles = [];

        for ($i=1; $i <= 5; $i++) {
            $article = new self();
            $article->id = $i;
            $article->title = 'Title '.$i;
            $article->description = 'Description '.$i;
            $article->content = 'Article '.$i;
            $article->slug = 'slug-'.$i;

            $articles[] = $article;
        }

        return $articles;
    }
}
