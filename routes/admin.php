<?php

use App\Http\Livewire\Admin\App\ManageApp;
use App\Http\Livewire\Admin\ManageApplicant;
use App\Http\Livewire\Admin\ManageAuthor;
use App\Http\Livewire\Admin\ManageAuthorList;
use App\Http\Livewire\Admin\ManageUser;
use App\Http\Livewire\Admin\ManageUserList;
use App\Http\Livewire\Admin\ManageWork;
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
  Route::get('/authors', ManageAuthorList::class)->name('admin.authors');
  Route::get('/authors/{id}', ManageAuthor::class)->name('admin.author');
  Route::get('/works/{id}', ManageWork::class)->name('admin.work');
  Route::get('/user', ManageUserList::class)->name('admin.users');
  Route::get('/user/{id}', ManageUser::class)->name('admin.user');
  Route::get('/app', ManageApp::class)->name('admin.app');
});
