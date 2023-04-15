<?php

namespace App\Http\Livewire\Applicant;

use App\Models\Applicant;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Delete extends Component
{
    use AuthorizesRequests;

    public $show;
    public Applicant $applicant;

    protected $rules = [
        'applicant' => ['required'],
    ];

    public function mount()
    {
        $this->fill([
            'show' => false,
            'applicant' => Applicant::where('user_id', auth()->user()->id)->first(),
        ]);
    }

    public function delete()
    {
        $this->authorize('delete', $this->applicant);

        $this->applicant->delete();

        $this->emit('refresh-navigation-menu');
        $this->dispatchBrowserEvent('alert', ['message' => 'Application withdrawn']);

        $this->show = false;
    }

    public function open()
    {
        $this->show = true;
    }

    public function render()
    {
        return view('livewire.applicant.delete');
    }
}
