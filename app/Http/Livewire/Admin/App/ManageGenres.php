<?php

namespace App\Http\Livewire\Admin\App;

use App\Models\Genre;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;

class ManageGenres extends Component
{
    use AuthorizesRequests;
    use WithPagination;

    public $showDeleteModal;

    public Genre $genreTo;
    public $name;

    public function openDeleteModal($id)
    {
        $this->genreTo = Genre::findOrFail($id);
        $this->name = $this->genreTo->name;
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        $this->authorize('manageApp', Admin::class);

        try {
            $this->genreTo->delete();
            $this->dispatchBrowserEvent('alert', ['message' => 'Genre eliminated successfully.']);
        } catch (\Throwable $th) {
            $this->dispatchBrowserEvent('alert', ['type' => 'danger', 'message' => 'There are works that use that genre.']);
        }

        $this->showDeleteModal = false;
    }

    public function render()
    {
        $genres = Genre::orderBy('name')->paginate(20);

        return view('livewire.admin.app.manage-genres', compact('genres'));
    }
}
