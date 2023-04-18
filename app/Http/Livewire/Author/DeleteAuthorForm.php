<?php

namespace App\Http\Livewire\Author;

use App\Models\Author;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class DeleteAuthorForm extends Component
{
    use AuthorizesRequests;

    public Author $author;
    public $show;

    public function mount($author)
    {
        $this->fill([
            'author' => $author,
            'show' => false,
        ]);
    }

    public function delete()
    {
        $this->authorize('delete', $this->author);

        $this->author->delete();

        return redirect()->to('/');
    }

    public function render()
    {
        return view('livewire.author.delete-author-form');
    }
}
