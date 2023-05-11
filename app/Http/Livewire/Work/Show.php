<?php

namespace App\Http\Livewire\Work;

use App\Models\Work;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;

class Show extends Component
{
    use AuthorizesRequests;
    use WithPagination;

    public Work $work;
    public $sortDirection = 'desc';
    public $lastChapterRead;

    protected $listeners = [
        'refresh-work-show' => '$refresh',
    ];

    protected $queryString = [
        'sortDirection' => ['except' => 'desc', 'as' => 'sort'],
    ];

    public function mount($slug)
    {
        $this->fill([
            $this->work = Work::where('slug', $slug)->firstOrFail(),
            $this->lastChapterRead = $this->checkLastChapterRead(),
        ]);
    }

    public function getChaptersProperty()
    {
        return $this->work->chapters()->orderBy('number', $this->sortDirection)->paginate(10);
    }

    public function setSortDirection()
    {
        $this->sortDirection = $this->sortDirection === 'desc' ? 'asc' : 'desc';
    }

    public function checkLastChapterRead()
    {
        
        if (auth()->check()) {
            $bookmark = $this->work->userBookmark();
            if ($bookmark) {
                return $bookmark->number;
            }
        }
        return 0;
    }

    public function bookmarkTo($chapterId)
    {
        $chapter = $this->work->chapters()->where('id', $chapterId);
        if ($chapter->exists()) {
            auth()->user()->bookmarks()->sync([$this->work->id => ['chapter_id' => $chapterId]], false);
            $this->lastChapterRead = $chapter->first()->number;
            $this->emitSelf('refresh-work-show');
        }
    }

    public function render()
    {
        $this->authorize('view', $this->work);

        return view('livewire.work.show');
    }
}
