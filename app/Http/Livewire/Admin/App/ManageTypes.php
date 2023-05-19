<?php

namespace App\Http\Livewire\Admin\App;

use App\Models\Type;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class ManageTypes extends Component
{
    use AuthorizesRequests;
    use WithPagination;

    public $showDeleteModal;
    public $showSaveModal;

    public Type $typeTo;
    public $name;

    protected function rules()
    {
        return [
            'typeTo.name' => [
                'required',
                Rule::unique('types', 'name')->ignore($this->typeTo->id),
                'max:70',
            ],
            'typeTo.slug' => [
                'required',
                Rule::unique('types', 'slug')->ignore($this->typeTo->id),
                'max:100',
            ],
            'typeTo.description' => [
                'required',
                Rule::unique('types', 'description')->ignore($this->typeTo->id),
            ],
        ];
    }

    protected $validationAttributes = [
        'slug' => 'name',
    ];

    public function openDeleteModal($id)
    {
        $this->typeTo = Type::findOrFail($id);
        $this->name = $this->typeTo->name;
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        $this->authorize('manageApp', Admin::class);

        try {
            $this->typeTo->delete();
            $this->dispatchBrowserEvent('alert', ['message' => 'Type eliminated successfully.']);
        } catch (\Throwable $th) {
            $this->dispatchBrowserEvent('alert', ['type' => 'danger', 'message' => 'There are works that use that type.']);
        }

        $this->showDeleteModal = false;
    }

    public function openSaveModal($id = null)
    {
        $this->resetErrorBag();
        $this->typeTo = Type::find($id) ?? new Type();
        $this->showSaveModal = true;
    }

    public function save()
    {
        $typeId = $this->typeTo->id;

        $this->typeTo->name = trim($this->typeTo->name);
        $this->typeTo->slug = str($this->typeTo->name)->slug();
        $this->typeTo->description = trim($this->typeTo->description);

        $this->validate();

        $this->typeTo->save();

        $this->showSaveModal = false;

        if ($typeId) {
            $this->dispatchBrowserEvent('alert', ['message' => 'Type updated successfully.']);
        } else {
            $this->dispatchBrowserEvent('alert', ['message' => 'Type created successfully.']);
        }
    }

    public function render()
    {
        $types = Type::orderBy('name')->paginate(20);

        return view('livewire.admin.app.manage-types', compact('types'));
    }
}
