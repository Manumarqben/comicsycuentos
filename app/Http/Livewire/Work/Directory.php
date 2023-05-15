<?php

namespace App\Http\Livewire\Work;

use App\Models\Genre;
use App\Models\State;
use Livewire\Component;

class Directory extends Component
{
    public $search;
    public $state;
    public $selectedGenres = [];

    protected $queryString = [
        'search' => ['except' => ''],
        'state' => ['except' => ''],
        'selectedGenres' => ['except' => '', 'as' => 'genre'],
    ];

    public function submitSearch()
    {
        $search = trim($this->search);

        $this->emitTo('work.list-works', 'setSearch', $search);
        $this->emitTo('work.list-works', 'setState', $this->state);
        $this->emitTo('work.list-works', 'setGenres', $this->selectedGenres);
        $this->emitTo('work.list-works', 'resetPagination');
    }

    public function resetData()
    {
        $this->reset();

        $this->submitSearch();
    }

    public function render()
    {
        $states = State::pluck('name', 'slug');
        $genres = Genre::pluck('name', 'slug');

        return view('livewire.work.directory', compact('states', 'genres'));
    }
}
