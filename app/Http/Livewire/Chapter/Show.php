<?php

namespace App\Http\Livewire\Chapter;

use App\Models\Chapter;
use Livewire\Component;

class Show extends Component
{
    public $chapter;

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
            $user = auth()->user();
            if ($user->works->contains($this->chapter->work)) {
                $lastChapterRead = $user->chapterBookmarks()->where('bookmarks.work_id', $this->chapter->work_id);
                if ($lastChapterRead->exists()) {
                    $lastChapterRead = $lastChapterRead->first()->number;
                } else {
                    $lastChapterRead = 0;
                }

                if ($this->chapter->number > $lastChapterRead) {
                    $user->addBookmark($this->chapter->work_id, $this->chapter->id);
                }
            }
        }
    }

    public function render()
    {
        return view('livewire.chapter.show');
    }
}
