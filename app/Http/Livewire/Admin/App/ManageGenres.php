<?php

namespace App\Http\Livewire\Admin\App;

use App\Models\Genre;
use Livewire\Component;
use Livewire\WithPagination;

class ManageGenres extends Component
{
    use WithPagination;

    public function render()
    {
        $genres = Genre::orderBy('name')->paginate(20);

        return view('livewire.admin.app.manage-genres', compact('genres'));
    }
}
