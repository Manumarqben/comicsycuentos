<?php

namespace App\Http\Livewire\Admin\App;

use App\Models\Age;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class ManageAges extends Component
{
    use AuthorizesRequests;
    use WithPagination;

    public $showDeleteModal;
    public $showSaveModal;

    public Age $ageTo;
    public $year;

    protected function rules()
    {
        return [
            'ageTo.year' => [
                'required',
                'integer',
                'min:0',
                Rule::unique('ages', 'year')->ignore($this->ageTo->id),

            ],
            'ageTo.description' => [
                'required',
                Rule::unique('ages', 'description')->ignore($this->ageTo->id),
            ],
        ];
    }

    public function openDeleteModal($id)
    {
        $this->ageTo = Age::findOrFail($id);
        $this->year = $this->ageTo->year;
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        $this->authorize('manageApp', Admin::class);

        try {
            $this->ageTo->delete();
            $this->dispatchBrowserEvent('alert', ['message' => 'Age eliminated successfully.']);
        } catch (\Throwable $th) {
            $this->dispatchBrowserEvent('alert', ['type' => 'danger', 'message' => 'There are works that use that age.']);
        }

        $this->showDeleteModal = false;
    }

    public function openSaveModal($id = null)
    {
        $this->resetErrorBag();
        $this->ageTo = Age::find($id) ?? new Age();
        $this->showSaveModal = true;
    }

    public function save()
    {
        $this->authorize('manageApp', Admin::class);

        $ageId = $this->ageTo->id;

        $this->ageTo->description = trim($this->ageTo->description);

        $this->validate();

        $this->ageTo->save();

        $this->showSaveModal = false;

        if ($ageId) {
            $this->dispatchBrowserEvent('alert', ['message' => 'Age updated successfully.']);
        } else {
            $this->dispatchBrowserEvent('alert', ['message' => 'Age created successfully.']);
        }
    }

    public function render()
    {
        $ages = Age::orderBy('year')->paginate(20);

        return view('livewire.admin.app.manage-ages', compact('ages'));
    }
}
