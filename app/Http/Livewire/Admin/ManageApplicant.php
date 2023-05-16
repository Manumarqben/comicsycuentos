<?php

namespace App\Http\Livewire\Admin;

use App\Models\Applicant;
use Livewire\Component;
use Livewire\WithPagination;

class ManageApplicant extends Component
{
    use WithPagination;

    public function render()
    {
        

        $applicants = Applicant::paginate(20);

        return view('livewire.admin.manage-applicant', compact('applicants'));
    }
}
