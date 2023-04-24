<?php

namespace App\Http\Livewire\Author;

use App\Models\Author;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Manage extends Component
{
    use AuthorizesRequests;

    public Author $author;

    public function mount($slug)
    {
        $this->author = Author::where('slug', $slug)->with('works')->firstOrFail();
    }

    public function render()
    {
        $this->authorize('update', $this->author);
        return view('livewire.author.manage');
    }
}
