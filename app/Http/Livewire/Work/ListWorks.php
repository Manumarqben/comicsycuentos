<?php

namespace App\Http\Livewire\Work;

use App\Models\Work;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class ListWorks extends Component
{
    use WithPagination;

    public $author;
    public $state;

    protected $queryString = [
        'state' => ['except' => ''],
    ];

    protected $listeners = [
        'setState'
    ];

    public function setState($state)
    {
        $this->state = $state;
    }

    private function childrenFilter()
    {
        if (auth()->check()) {
            $age = Carbon::parse(auth()->user()->birthdate)->age;
            if ($age >= 18) {
                return Work::query();
            }
        }
        return Work::whereHas('age', function ($query) {
            $query->where('year', '<', 18);
        });
    }

    public function render()
    {
        $works = $this->childrenFilter();

        $works->where('author_id', $this->author);

        $works->whereHas('state', function ($query) {
            $query->where('slug', $this->state);
        });

        $works = $works->paginate(12);

        return view('livewire.work.list-works', compact('works'));
    }
}
