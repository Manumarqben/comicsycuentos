<?php

namespace App\Http\Livewire\Admin;

use App\Models\Author;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;

class ManageAuthor extends Component
{
    use AuthorizesRequests;
    use WithPagination;

    public $showDeleteModal = false;
    public $showEditModal = false;

    public Author $authorTo;
    public $alias = '';

    public function openDeleteModal($id)
    {
        $this->authorTo = Author::findOrFail($id);
        $this->alias = $this->authorTo->alias;
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        $this->authorize('manageAuthor', Admin::class);

        $this->authorTo->delete();

        $this->showDeleteModal = false;

        $this->emit('refresh-navigation-menu');
        $this->dispatchBrowserEvent('alert', ['message' => 'Author removed successfully.']);
    }

    public function render()
    {
        $authors = Author::paginate(20);

        return view('livewire.admin.manage-author', compact('authors'));
    }
}
