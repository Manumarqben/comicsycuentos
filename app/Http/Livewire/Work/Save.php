<?php

namespace App\Http\Livewire\Work;

use App\Models\Age;
use App\Models\State;
use App\Models\Type;
use App\Models\Work;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Save extends Component
{
    use AuthorizesRequests;

    public Work $work;

    protected $rules = [
        'work.title' => [
            'unique:works,title',
            'max:200',
            'required',
        ],
        'work.slug' => [
            'unique:works,slug',
            'max:255',
            'required',
        ],
        'work.synopsis' => [
            'unique:works,synopsis',
            'required',
        ],
        'work.author_id' => [
            'required',
        ],
        'work.type_id' => [
            'required'
        ],
        'work.state_id' => [
            'required'
        ],
        'work.age_id' => [
            'required'
        ],
    ];

    protected $validationAttributes = [
        'slug' => "title",
        'author_id' => "author",
        'type_id' => "type",
        'state_id' => "state",
        'age_id' => "age",
    ];

    public function mount()
    {
        $this->fill([
            $this->work = new Work(),
        ]);
    }

    public function submit()
    {
        $this->authorize('create', Work::class);
        $this->work->title = trim($this->work->title);
        $this->work->slug = str($this->work->title)->slug();
        $this->work->synopsis = trim($this->work->synopsis);
        $this->work->author_id = auth()->user()->author->id;

        $this->validate();

        //     $this->work->save();

        $this->dispatchBrowserEvent('alert', ['message' => 'Work created successfully']);
    }

    public function render()
    {
        $types = Type::pluck('name', 'id');
        $states = State::pluck('name', 'id');
        $ages = Age::pluck('year', 'id');

        return view('livewire.work.save', compact('types', 'states', 'ages'));
    }
}
