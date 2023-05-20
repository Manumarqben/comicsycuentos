<?php

namespace App\Http\Livewire\Admin;

use App\Models\Author;
use Livewire\Component;

class ManageAuthor extends Component
{
    public Author $author;

    public function mount($id)
    {
        $this->fill([
            'author' => Author::where('id', $id)->with('works', 'works.chapters')->firstOrFail(),
        ]);
    }
    public function render()
    {
        return view('livewire.admin.manage-author');
    }
}
