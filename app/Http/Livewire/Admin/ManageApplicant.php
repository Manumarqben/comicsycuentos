<?php

namespace App\Http\Livewire\Admin;

use App\Models\Admin;
use App\Models\Applicant;
use App\Models\Author;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;

class ManageApplicant extends Component
{
    use AuthorizesRequests;
    use WithPagination;

    public $showDeleteModal = false;
    public $showAcceptModal = false;

    public Applicant $applicantTo;
    public $alias = '';

    protected  $rules = [
        'applicantTo.user_id' => [
            'unique:authors,user_id',
        ],
        'applicantTo.alias' => [
            'max:50',
            'unique:authors,alias',
        ],
        'applicantTo.slug' => [
            'max:80',
            'unique:authors,slug',
        ],
    ];

    public function openDeleteModal($id)
    {
        $this->applicantTo = Applicant::findOrFail($id);
        $this->alias = $this->applicantTo->alias;
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        $this->authorize('manageApplicant', Admin::class);

        $this->applicantTo->delete();

        $this->showDeleteModal = false;

        $this->emit('refresh-navigation-menu');
        $this->dispatchBrowserEvent('alert', ['message' => 'Rejected applicant']);
    }

    public function openAcceptModal($id)
    {
        $this->applicantTo = Applicant::findOrFail($id);
        $this->alias = $this->applicantTo->alias;
        $this->showAcceptModal = true;
    }

    public function acceptAsAuthor()
    {
        $this->authorize('manageApplicant', Admin::class) &&
            $this->authorize('create', Author::class);

        $this->validate();

        Author::create([
            'alias' => $this->applicantTo->alias,
            'slug' => $this->applicantTo->slug,
            'user_id' => $this->applicantTo->user_id,
        ]);

        $this->applicantTo->delete();

        $this->showAcceptModal = false;

        $this->dispatchBrowserEvent('alert', ['message' => 'Applicant accepted']);
    }

    public function render()
    {
        $applicants = Applicant::paginate(20);

        return view('livewire.admin.manage-applicant', compact('applicants'));
    }
}
