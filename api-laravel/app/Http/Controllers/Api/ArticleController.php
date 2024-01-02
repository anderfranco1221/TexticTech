<?php

namespace App\Http\Controllers\Api;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\ArticleCollection;

class ArticleController extends Controller
{
    public function index():ArticleCollection{
        
        return ArticleCollection::make(Article::all());
    }

    public function show(Article $article): ArticleResource{
        //dd($article->toArray());
        return ArticleResource::make($article);
    }

    public function create(Request $request){
        
        $article = Article::create([
            'title' => $request->input('data.atributes.title'),
            'slug' => $request->input('data.atributes.slug'),
            'content' => $request->input('data.atributes.content'),
        ]);

        return ArticleResource::make($article);
    }
}
