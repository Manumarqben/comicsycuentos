<?php

namespace App\Http\Livewire\Applicant;

use App\Models\Applicant;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Save extends Component
{
    use AuthorizesRequests;

    public $show;
    public Applicant $applicant;

    protected $listeners = [
        'open',
    ];

    protected  $rules = [
        'applicant.user_id' => [
            'unique:applicants,user_id',
            'unique:authors,user_id',
        ],
        'applicant.alias' => [
            'max:50',
            'unique:applicants,alias',
            'unique:authors,alias',
        ],
        'applicant.slug' => [
            'max:80',
            'unique:applicants,slug',
            'unique:authors,slug',
        ],
    ];

    protected $messages = [
        'applicant.user_id.unique' => 'The user cannot apply.'
    ];

    protected $validationAttributes = [
        'slug' => "alias",
    ];

    public function mount()
    {
        $this->fill([
            $this->show = false,
            $this->applicant = new Applicant(),
        ]);
    }

    public function submit()
    {
        $this->authorize('create', $this->applicant);

        $this->applicant->alias = $this->applicant->alias ? trim($this->applicant->alias) : auth()->user()->name;
        $this->applicant->slug = str($this->applicant->alias)->slug();
        $this->applicant->user_id = auth()->user()->id;
        $this->applicant->created_at = now();

        $this->validate();
        
        $this->applicant->save();

        $this->emit('refresh-navigation-menu');

        $this->dispatchBrowserEvent('alert', ['message' => 'Application sent successfully']);

        $this->show = false;
    }

    public function open()
    {
        $this->show = true;
        // TODO: resetear datos cuando abra el componente?
    }

    public function render()
    {
        return view('livewire.applicant.save');
    }
}
