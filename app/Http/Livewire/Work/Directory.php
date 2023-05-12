<?php

namespace App\Http\Livewire\Work;

use Livewire\Component;

class Directory extends Component
{
    public $search;

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public function submitSearch()
    {
        $search = trim($this->search);

        $this->emitTo('work.list-works', 'setSearch', $search);
        $this->emitTo('work.list-works', 'resetPagination');
    }

    public function resetData()
    {
        $this->reset([
            'search',
        ]);

        $this->submitSearch();
    }

    public function render()
    {
        return view('livewire.work.directory');
    }
}
