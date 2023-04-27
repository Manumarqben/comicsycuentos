<?php

use App\Http\Livewire\Chapter\Save as ChapterSave;
use App\Http\Livewire\Chapter\Show as ChapterShow;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Chapter Routes
|--------------------------------------------------------------------------
|
| Aquí se registran las rutas relacionadas con los capítulos.
|
*/

Route::get('/viewer/{workSlug}/chapter-{chapterNumber}', ChapterShow::class)->name('chapter.viewer');

Route::group([
  'middleware' => [
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'author',
    'chapter',
  ]
], function () {
  Route::get('/works/work/{workSlug}/chapter/create', ChapterSave::class)->name('chapter.create');
  Route::get('/works/work/{workSlug}/chapter-{chapterNumber}/update', ChapterSave::class)->name('chapter.update');
});
