<?php

namespace App\Http\Livewire\Admin\App;

use App\Models\State;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class ManageStates extends Component
{
    use AuthorizesRequests;
    use WithPagination;
    
    public $showDeleteModal;
    public $showSaveModal;

    public State $stateTo;
    public $name;

    protected function rules()
    {
        return [
            'stateTo.name' => [
                'required',
                Rule::unique('states', 'name')->ignore($this->stateTo->id),
                'max:70',
            ],
            'stateTo.slug' => [
                'required',
                Rule::unique('states', 'slug')->ignore($this->stateTo->id),
                'max:100',
            ],
            'stateTo.description' => [
                'required',
                Rule::unique('states', 'description')->ignore($this->stateTo->id),
            ],
        ];
    }

    protected $validationAttributes = [
        'slug' => 'name',
    ];

    public function openDeleteModal($id)
    {
        $this->stateTo = State::findOrFail($id);
        $this->name = $this->stateTo->name;
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        $this->authorize('manageApp', Admin::class);

        try {
            $this->stateTo->delete();
            $this->dispatchBrowserEvent('alert', ['message' => 'State eliminated successfully.']);
        } catch (\Throwable $th) {
            $this->dispatchBrowserEvent('alert', ['type' => 'danger', 'message' => 'There are works that use that state.']);
        }

        $this->showDeleteModal = false;
    }

    public function openSaveModal($id = null)
    {
        $this->resetErrorBag();
        $this->stateTo = State::find($id) ?? new State();
        $this->showSaveModal = true;
    }

    public function save()
    {
        $stateId = $this->stateTo->id;

        $this->stateTo->name = trim($this->stateTo->name);
        $this->stateTo->slug = str($this->stateTo->name)->slug();
        $this->stateTo->description = trim($this->stateTo->description);

        $this->validate();

        $this->stateTo->save();

        $this->showSaveModal = false;

        if ($stateId) {
            $this->dispatchBrowserEvent('alert', ['message' => 'State updated successfully.']);
        } else {
            $this->dispatchBrowserEvent('alert', ['message' => 'State created successfully.']);
        }
    }

    public function render()
    {
        $states = State::orderBy('name')->paginate(20);

        return view('livewire.admin.app.manage-states', compact('states'));
    }
}
