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

    public $markerInfoModal = false;

    protected $listeners = [
        'refresh-work-show' => '$refresh',
        'setLastChapterRead',
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
        $user = auth()->user();

        if ($user->works->contains($this->work)) {
            $chapter = $this->work->chapters()->where('id', $chapterId);

            if ($chapter->exists()) {
                $changeBookmark = $user->addBookmark($this->work->id, $chapter->first()->id);

                if ($changeBookmark) {
                    $this->setLastChapterRead($chapter->first()->number);
                    $this->emitSelf('refresh-work-show');
                }
            }
        } else {
            $this->markerInfoModal = true;
        }
    }

    public function deleteBookmark()
    {
        if (auth()->check()) {
            auth()->user()->deleteBookmark($this->work->id);
            $this->setLastChapterRead(0);
            $this->emitSelf('refresh-work-show');
        }
    }

    public function setLastChapterRead($number)
    {
        $this->lastChapterRead = $number;
    }

    public function render()
    {
        $this->authorize('view', $this->work);

        return view('livewire.work.show');
    }
}
