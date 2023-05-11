<?php

namespace App\Http\Livewire\Chapter;

use App\Models\Chapter;
use Livewire\Component;

class Show extends Component
{
    public $chapter;
    public $typeContent;

    public function mount($workSlug, $chapterNumber)
    {
        $this->fill([
            $this->chapter = Chapter::where('number', $chapterNumber)
                ->whereHas('work', function ($query) use ($workSlug) {
                    $query->where('slug', $workSlug);
                })
                ->firstOrFail(),
        ]);

        if (auth()->check()) {
            $lastChapterRead = auth()->user()->chapterBookmarks()->where('bookmarks.work_id', $this->chapter->work_id)->first()->number;
    
            if ($this->chapter->number > $lastChapterRead) {
                auth()->user()->bookmarks()->sync([$this->chapter->work_id => ['chapter_id' => $this->chapter->id]], false);
            }
        }
    }

    public function render()
    {
        if ($this->chapter->text) {
            $this->typeContent = 'text';
            // TODO: vista (o componente?) aparte para lector de texto.
            return view('livewire.chapter.show');
        }

        if ($this->chapter->images->isNotEmpty()) {
            $this->typeContent = 'images';
            $content = $this->chapter->images()->orderBy('order')->get();
            // TODO: vista (o componente?) aparte para lector de imagenes, con sus opciones (paginación, cascada, etc...).
            return view('livewire.chapter.show', compact('content'));
        }
    }
}
