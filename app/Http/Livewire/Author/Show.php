<?php

namespace App\Http\Livewire\Author;

use App\Models\Author;
use Livewire\Component;

class Show extends Component
{
    public Author $author;
    public $state = 'publishing';

    public function setState($newState)
    {
        $this->state = $newState;
        $this->emitTo('work.list-works', 'setState', $newState);
    }

    public function mount($slug)
    {
        $this->fill([
            $this->author = Author::where('slug', $slug)->firstOrFail(),
        ]);
    }

    public function render()
    {
        return view('livewire.author.show');
    }
}
