<?php

namespace App\Http\Livewire\Work;

use App\Models\Age;
use App\Models\Genre;
use App\Models\State;
use App\Models\Type;
use Livewire\Component;

class Directory extends Component
{
    public $search;
    public $state;
    public $type;
    public $age;

    public $selectedGenres = [];
    public $urlGenres;

    public $sortDirection = 'asc';

    protected $queryString = [
        'search' => ['except' => ''],
        'state' => ['except' => ''],
        'age' => ['except' => ''],
        'type' => ['except' => ''],
        'urlGenres' => ['except' => '', 'as' => 'genres'],
        'sortDirection' => ['except' => 'asc', 'as' => 'sortDirection'],
    ];

    public function updatedSortDirection()
    {
        $this->emitTo('work.list-works', 'setSort', 'title', $this->sortDirection);
    }

    public function updatedSelectedGenres()
    {
        $this->urlGenres = implode(',', $this->selectedGenres);
    }

    public function mount()
    {
        if ($this->urlGenres) {
            $this->selectedGenres = explode(',', $this->urlGenres);
        }
    }

    public function submitSearch()
    {
        $search = trim($this->search);

        $this->emitTo('work.list-works', 'setSearch', $search);
        $this->emitTo('work.list-works', 'setState', $this->state);
        $this->emitTo('work.list-works', 'setType', $this->type);
        $this->emitTo('work.list-works', 'setAge', $this->age);
        $this->emitTo('work.list-works', 'setGenres', $this->selectedGenres);
        $this->emitTo('work.list-works', 'resetPagination');
    }

    public function resetData()
    {
        $this->reset();

        $this->emitTo('work.list-works', 'setSort', 'title', 'asc');
        $this->submitSearch();
    }

    public function render()
    {
        $states = State::orderBy('name')->pluck('name', 'slug');
        $types = Type::orderBy('name')->pluck('name', 'slug');
        $ages = Age::orderBy('year')->pluck('year', 'id');
        $genres = Genre::orderBy('name')->pluck('name', 'slug');

        return view('livewire.work.directory', compact('states', 'types', 'ages', 'genres'));
    }
}
