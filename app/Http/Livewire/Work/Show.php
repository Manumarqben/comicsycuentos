<?php

namespace App\Http\Livewire\Work;

use App\Models\Work;
use Livewire\Component;
use Livewire\WithPagination;

class Show extends Component
{
    use WithPagination;

    public Work $work;
    public $sortDirection = 'desc';

    protected $queryString = [
        'sortDirection' => ['except' => 'desc', 'as' => 'sort'],
    ];

    public function mount($slug)
    {
        $this->fill([
            $this->work = Work::where('slug', $slug)->firstOrFail(),
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

    public function render()
    {
        return view('livewire.work.show');
    }
}
