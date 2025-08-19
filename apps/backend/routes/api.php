<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Middleware\ValidateJsonApiHeaders;
use App\Http\Middleware\ValidateJsonApiDocument;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::withoutMiddleware([ValidateJsonApiDocument::class, ValidateJsonApiHeaders::class])
    ->group(function () {
        Route::post("login", LoginController::class)->name('login');
    });

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); */

Route::apiResource('categories', CategoriaController::class);
//->only(["index", "store"]);
Route::apiResource('productos', ProductoController::class);
Route::apiResource('materials', MaterialController::class);
