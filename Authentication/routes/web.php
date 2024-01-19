<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(AuthController::class)->group(function(){
    Route::get('/', 'create_login')->name('create_login');
    Route::post('login', 'login')->name('login');
    Route::get('logout', 'logout')->name('logout');
    Route::get('create_register', 'create_register')->name('create_register');
    Route::post('register', 'register')->name('register');
});

Route::view('home', 'welcome')->name('home');
