<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use DamianPhp\Validation\Validator;
use App\Http\Controllers\Controller;
use DamianPhp\Support\Facades\Input;
use DamianPhp\Support\Facades\Request;

/**
 * Syntax example for an Admin ArticleController.
 */
class ArticleController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->setLayout('admin');
    }

    public function index()
    {
        $articles = Article::load()
            ->select('title, description, content')
            ->findAll();

        return $this->view('admin/article/index', [
            'articles' => $articles,
        ]);
    }

    public function create()
    {
        return $this->view('admin/article/create');
    }

    public function store(Validator $validator)
    {
        $validator->rules([ // Add your rules in the array.
            'title' => ['max' => 190, 'required' => true],
            'description' => ['max' => 190, 'required' => true],
            'content' => ['required' => true],
            'slug' => [
                'required' => true,
                'max' => 190,
                'format_slug' => true,
                'unique' => [
                    'model' => Article::class,
                    'where' => [['slug','=',Input::post('slug')]],
                ],
            ],
        ]);

        if ($validator->isValid()) {
            $article = new Article();
            $article->fill(Request::getPost()->all());
            $article->save();

        // Success. Redirect or JSON response...
        } else {
            // Error. Redirect or JSON response...
        }
    }

    public function edit(int $id)
    {
        $article = Article::load()->findOrFail($id);

        return $this->view('admin/article/edit', [
            'article' => $article,
        ]);
    }

    public function update(Validator $validator, int $id)
    {
        $article = Article::load()->findOrFail($id);

        $validator->rules([ // Add your rules in the array.
            'title' => ['max' => 190, 'required' => true],
            'description' => ['max' => 190, 'required' => true],
            'content' => ['required' => true],
            'slug' => [
                'required' => true,
                'max' => 190,
                'format_slug' => true,
                'unique' => [
                    'model' => Article::class,
                    'where' => [['slug', '=', Input::post('slug'), 'AND'], ['id', '!=', $id]],
                ],
            ],
        ]);

        if ($validator->isValid()) {
            $article->fill(Request::getPost()->all());
            $article->save();

        // Success. Redirect or JSON response...
        } else {
            // Error. Redirect or JSON response...
        }
    }

    public function destroy(int $id)
    {
        $article = Article::load()->findOrFail($id);
        $article->delete();

        // Redirect or JSON response...
    }
}
