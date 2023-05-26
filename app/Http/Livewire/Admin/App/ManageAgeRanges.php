<?php

namespace App\Http\Livewire\Admin\App;

use App\Models\Age;
use App\Models\AgeRange;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class ManageAgeRanges extends Component
{
    use AuthorizesRequests;
    use WithPagination;

    public $showDeleteModal;
    public $showSaveModal;

    public AgeRange $ageRangeTo;
    public $name;

    protected function rules()
    {
        return [
            'ageRangeTo.name' => [
                'required',
                Rule::unique('age_ranges', 'name')->ignore($this->ageRangeTo->id),
                'max:50',
            ],
            'ageRangeTo.slug' => [
                'required',
                Rule::unique('age_ranges', 'slug')->ignore($this->ageRangeTo->id),
                'max:70',
            ],
            'ageRangeTo.age_min' => [
                'required',
                'exists:ages,id',
            ],
            'ageRangeTo.age_max' => [
                'required',
                'exists:ages,id',
                Rule::unique('age_ranges', 'age_max')->where('age_min', $this->ageRangeTo->age_min)->ignore($this->ageRangeTo->id),
            ],
        ];
    }

    protected $messages = [
        // 'ageRangeTo.age_max.gte' => 'The age max field must be greater than or equal to minimum age',
        'ageRangeTo.age_max.unique' => 'There is already a range with the combination of minimum age and maximum age.',
    ];

    protected $validationAttributes = [
        'slug' => 'name',
    ];


    public function openDeleteModal($id)
    {
        $this->ageRangeTo = AgeRange::findOrFail($id);
        $this->name = $this->ageRangeTo->name;
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        $this->authorize('manageApp', Admin::class);

        $this->ageRangeTo->delete();
        $this->dispatchBrowserEvent('alert', ['message' => 'Range eliminated successfully.']);

        $this->showDeleteModal = false;
    }

    public function openSaveModal($id = null)
    {
        $this->resetErrorBag();
        $this->ageRangeTo = AgeRange::find($id) ?? new AgeRange();
        $this->showSaveModal = true;
    }

    public function save()
    {
        $ageRangeId = $this->ageRangeTo->id;

        $this->ageRangeTo->name = trim($this->ageRangeTo->name);
        $this->ageRangeTo->slug = str($this->ageRangeTo->name)->slug();

        $this->validate();

        if ($this->ageRangeTo->minAge->year <= $this->ageRangeTo->maxAge->year) {
            $this->ageRangeTo->save();

            $this->showSaveModal = false;

            if ($ageRangeId) {
                $this->dispatchBrowserEvent('alert', ['message' => 'Range updated successfully.']);
            } else {
                $this->dispatchBrowserEvent('alert', ['message' => 'Range created successfully.']);
            }
        } else {
            $this->addError('ageRangeTo.age_max', 'The age max field must be greater than or equal to minimum age.');
        }
    }

    public function render()
    {
        $ranges = AgeRange::orderBy('name')->paginate(20);
        $ages = Age::orderBy('year')->pluck('year', 'id');

        return view('livewire.admin.app.manage-age-ranges', compact('ranges', 'ages'));
    }
}
