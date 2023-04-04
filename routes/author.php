<?php

use App\Http\Livewire\Author\Show as AuthorShow;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Works Routes
|--------------------------------------------------------------------------
|
| Aquí se registran las rutas relacionadas con las obras.
|
*/

Route::group(['prefix' => 'authors'], function () {
  Route::get('/{slug}', AuthorShow::class)->name('author.show');
});
