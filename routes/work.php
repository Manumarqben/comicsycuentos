<?php

use App\Http\Livewire\Work\Directory;
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
  Route::get('/{slug}', WorkShow::class)->name('work.show');
});
