<?php

namespace App\Http\Livewire\Admin\App;

use App\Models\Genre;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class ManageGenres extends Component
{
    use AuthorizesRequests;
    use WithPagination;

    public $showDeleteModal;
    public $showSaveModal;

    public Genre $genreTo;
    public $name;

    protected function rules()
    {
        return [
            'genreTo.name' => [
                'required',
                Rule::unique('genres', 'name')->ignore($this->genreTo->id),
                'max:70',
            ],
            'genreTo.slug' => [
                'required',
                Rule::unique('genres', 'slug')->ignore($this->genreTo->id),
                'max:100',
            ],
            'genreTo.description' => [
                'required',
                Rule::unique('genres', 'description')->ignore($this->genreTo->id),
            ],
        ];
    }

    protected $validationAttributes = [
        'slug' => 'name',
    ];

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

    public function openSaveModal($id = null)
    {
        $this->genreTo = Genre::find($id) ?? new Genre();
        $this->showSaveModal = true;
    }

    public function save()
    {
        $genreId = $this->genreTo->id;

        $this->genreTo->name = trim($this->genreTo->name);
        $this->genreTo->slug = str($this->genreTo->name)->slug();
        $this->genreTo->description = trim($this->genreTo->description);

        $this->validate();

        $this->genreTo->save();

        $this->showSaveModal = false;

        if ($genreId) {
            $this->dispatchBrowserEvent('alert', ['message' => 'Genre updated successfully.']);
        } else {
            $this->dispatchBrowserEvent('alert', ['message' => 'Genre created successfully.']);
        }
    }

    public function render()
    {
        $genres = Genre::orderBy('name')->paginate(20);

        return view('livewire.admin.app.manage-genres', compact('genres'));
    }
}
