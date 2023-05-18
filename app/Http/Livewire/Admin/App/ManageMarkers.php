<?php

namespace App\Http\Livewire\Admin\App;

use App\Models\Marker;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class ManageMarkers extends Component
{
    use AuthorizesRequests;
    use WithPagination;

    public $showDeleteModal;
    public $showSaveModal;

    public Marker $markerTo;
    public $name;

    protected function rules()
    {
        return [
            'markerTo.name' => [
                'required',
                Rule::unique('markers', 'name')->ignore($this->markerTo->id),
                'max:70',
            ],
            'markerTo.slug' => [
                'required',
                Rule::unique('markers', 'slug')->ignore($this->markerTo->id),
                'max:100',
            ],
            'markerTo.description' => [
                'required',
                Rule::unique('markers', 'description')->ignore($this->markerTo->id),
            ],
        ];
    }

    protected $validationAttributes = [
        'slug' => 'name',
    ];

    public function openDeleteModal($id)
    {
        $this->markerTo = Marker::findOrFail($id);
        $this->name = $this->markerTo->name;
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        $this->authorize('manageApp', Admin::class);

        try {
            $this->markerTo->delete();
            $this->dispatchBrowserEvent('alert', ['message' => 'Marker eliminated successfully.']);
        } catch (\Throwable $th) {
            $this->dispatchBrowserEvent('alert', ['type' => 'danger', 'message' => 'There are works that use that marker.']);
        }

        $this->showDeleteModal = false;
    }

    public function openSaveModal($id = null)
    {
        $this->markerTo = Marker::find($id) ?? new Marker();
        $this->showSaveModal = true;
    }

    public function save()
    {
        $markerId = $this->markerTo->id;

        $this->markerTo->name = trim($this->markerTo->name);
        $this->markerTo->slug = str($this->markerTo->name)->slug();
        $this->markerTo->description = trim($this->markerTo->description);

        $this->validate();

        $this->markerTo->save();

        $this->showSaveModal = false;

        if ($markerId) {
            $this->dispatchBrowserEvent('alert', ['message' => 'Marker updated successfully.']);
        } else {
            $this->dispatchBrowserEvent('alert', ['message' => 'Marker created successfully.']);
        }
    }

    public function render()
    {
        $markers = Marker::orderBy('name')->paginate(20);

        return view('livewire.admin.app.manage-markers', compact('markers'));
    }
}
