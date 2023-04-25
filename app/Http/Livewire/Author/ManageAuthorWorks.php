<?php

namespace App\Http\Livewire\Author;

use App\Models\Author;
use Livewire\Component;

class ManageAuthorWorks extends Component
{
    public Author $author;

    protected $listeners = [
        'refresh-manege-author-works' => '$refresh',
    ];

    public function mount($author)
    {
        $this->fill([
            'author' => $author,
        ]);
    }

    public function render()
    {
        return view('livewire.author.manage-author-works');
    }
}
