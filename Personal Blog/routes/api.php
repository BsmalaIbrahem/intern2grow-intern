<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArticleController;
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

Route::middleware('auth:sanctum')->group(function(){
    Route::controller(ArticleController::class)->prefix('article')->group(function(){
        Route::post('/add', 'store');
        Route::get('/{id}', 'shows');
        Route::get('/', 'index');
        Route::delete('/delete/{id}', 'destroy');
        Route::put('/update/{id}', 'update');
    });
    Route::get('/PersonalArticles', [ArticleController::class, 'getPersonal']);
});

Route::controller(AuthController::class)->group(function(){
    Route::post('/sign-up', 'signUp');
    Route::post('/login', 'login');
});
