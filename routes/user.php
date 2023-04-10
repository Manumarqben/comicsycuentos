<?php

use App\Http\Livewire\User\Library;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Works Routes
|--------------------------------------------------------------------------
|
| Aquí se registran las rutas relacionadas con las obras.
|
*/

Route::group([
  'prefix' => 'user',
  'middleware' => [
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
  ],
], function () {
  Route::get('/library', Library::class)->name('user.library');
});
