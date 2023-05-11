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
    public $bookmark;

    protected $queryString = [
        'sortDirection' => ['except' => 'desc', 'as' => 'sort'],
    ];

    public function mount($slug)
    {
        $this->fill([
            $this->work = Work::where('slug', $slug)->firstOrFail(),
            $this->bookmark = $this->checkBookmark(),
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

    public function checkBookmark()
    {
        $bookmark = $this->work->userBookmark();
        if ($bookmark) {
            return $bookmark->number;
        }
        return 0;
    }

    public function render()
    {
        $this->authorize('view', $this->work);

        return view('livewire.work.show');
    }
}
