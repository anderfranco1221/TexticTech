<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ArticleController;

/*
Route::bind('article', function($article){
    return \App\Models\Article::where('slug', $article)
    ->sparseFieldset()
    ->firstOrFail();
});*/

Route::apiResource('articles', ArticleController::class)->names('api.v1.articles');
