<?php

namespace App\Http\Livewire\Work;

use App\Models\Age;
use App\Models\State;
use App\Models\Type;
use App\Models\Work;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithFileUploads;

class Save extends Component
{
    use AuthorizesRequests;
    use WithFileUploads;

    public Work $work;
    public $frontPage;

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
        'work.age_id' => [
            'required',
            'exists:ages,id',
        ],
        'work.state_id' => [
            'required',
            'exists:states,id',
        ],
        'work.type_id' => [
            'required',
            'exists:types,id',
        ],
        'work.author_id' => [
            'required',
            'exists:authors,id',
        ],
    ];

    protected $validationAttributes = [
        'slug' => "title",
        'author_id' => "author",
        'type_id' => "type",
        'state_id' => "state",
        'age_id' => "age",
    ];

    public function updatedFrontPage()
    {
        $this->validate([
            'frontPage' => [
                'image',
                'max:1024',
                'required',
            ],
        ]);
    }

    public function mount()
    {
        $this->fill([
            $this->work = new Work(),
        ]);
    }

    public function getFrontPagePathProperty()
    {
        if ($this->frontPage) {
            return $this->frontPage->temporaryUrl();
        }
    }

    public function submit()
    {
        $this->authorize('create', Work::class);
        $this->work->title = trim($this->work->title);
        $this->work->slug = str($this->work->title)->slug();
        $this->work->synopsis = trim($this->work->synopsis);
        $this->work->author_id = auth()->user()->author->id;

        $this->validate();

        $path = $this->frontPage->store('front_pages', 'public');
        $this->work->front_page = $path;

        $this->work->save();

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
