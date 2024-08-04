<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\CategoryController;

/*
Route::bind('article', function($article){
    return \App\Models\Article::where('slug', $article)
    ->sparseFieldset()
    ->firstOrFail();
});*/

//Route::name('api.v1.', function(){

Route::apiResource('articles', ArticleController::class);
//    ->names('api.v1.articles');

Route::apiResource('categories', CategoryController::class)
    ->only('index', 'show');

Route::get('articles/{article}/relationships/category', fn()=> 'TODO')
    ->name('articles.relationships.category');

Route::get('articles/{article}/category', fn()=> 'TODO')
    ->name('articles.category');
    //    ->names('api.v1.categories')
//});

/*
Route::apiResource([
    'articles' => ArticleController::class,
    'categories' => CategoryController::class,
]); */
