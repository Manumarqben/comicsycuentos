<?php

use App\Http\Livewire\Admin\ManageApplicant;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admins Routes
|--------------------------------------------------------------------------
|
| Aquí se registran las rutas relacionadas con la administración de la aplicación.
|
*/

Route::group([
  'prefix' => 'admin',
  'middleware' => [
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'admin',
  ],
], function () {
  Route::get('/applicants', ManageApplicant::class)->name('admin.applicants');
});
