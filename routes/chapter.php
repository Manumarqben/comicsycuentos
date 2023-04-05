<?php

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



Route::get('/viewer/{workSlug}/{chapterNumber}', ChapterShow::class)->name('chapter.viewer');
