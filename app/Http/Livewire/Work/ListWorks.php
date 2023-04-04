<?php

namespace App\Http\Livewire\Work;

use App\Models\Work;
use Livewire\Component;
use Livewire\WithPagination;

class ListWorks extends Component
{
    use WithPagination;

    public $author;

    public function render()
    {
        $works = Work::where('author_id', $this->author);

        $works = $works->paginate(12);

        return view('livewire.work.list-works', compact('works'));
    }
}
