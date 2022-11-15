<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgeController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\SocialNetworkController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\WorkController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'is.admin',
    ])->group(function () {
    Route::resource('admins', AdminController::class);
    Route::resource('types', TypeController::class);
    Route::resource('networks', SocialNetworkController::class);
    Route::resource('genres', GenreController::class);
    Route::resource('ages', AgeController::class);
    Route::resource('states', StateController::class);
    Route::resource('authors', AuthorController::class);
    Route::resource('works', WorkController::class);
});
