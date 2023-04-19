<?php

use App\Http\Livewire\Work\Directory;
use App\Http\Livewire\Work\Save as WorkSave;
use App\Http\Livewire\Work\Show as WorkShow;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Works Routes
|--------------------------------------------------------------------------
|
| Aquí se registran las rutas relacionadas con las obras.
|
*/

Route::group(['prefix' => 'works'], function () {
  Route::get('/', Directory::class)->name('works.directory');
  Route::get('/work/{slug}', WorkShow::class)->name('work.show');

  Route::group([
    'middleware' => [
      'auth:sanctum',
      config('jetstream.auth_session'),
      'verified',
      'author',
    ],
  ], function () {
    Route::get('/create', WorkSave::class)->name('work.create');
  });

});
