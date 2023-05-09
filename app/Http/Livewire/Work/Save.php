<?php

namespace App\Http\Livewire\Work;

use App\Models\Age;
use App\Models\State;
use App\Models\Type;
use App\Models\Work;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class Save extends Component
{
    use AuthorizesRequests;
    use WithFileUploads;

    public Work $work;
    public $frontPage;

    protected function rules()
    {
        return    $rules = [
            'work.title' => [
                Rule::unique('works', 'title')->ignore($this->work->id),
                'max:200',
                'required',
            ],
            'work.slug' => [
                Rule::unique('works', 'slug')->ignore($this->work->id),
                'max:255',
                'required',
            ],
            'work.synopsis' => [
                Rule::unique('works', 'synopsis')->ignore($this->work->id),
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
            'frontPage' => [
                'required',
            ],
        ];
    }

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
            ],
        ]);
    }

    public function mount($slug = null)
    {
        if ($slug != null) {
            $work = Work::where('slug', $slug)->firstOrFail();
        }

        $this->fill([
            $this->work = $work ?? new Work(),
        ]);
    }

    public function getFrontPagePathProperty()
    {
        if ($this->frontPage) {
            try {
                return $this->frontPage->temporaryUrl();
            } catch (Exception $e) {}
        }

        if ($this->work->front_page) {
            return asset(Storage::url($this->work->front_page));
        }
    }

    public function submit()
    {
        $this->work->id ?
            $this->authorize('update', $this->work) :
            $this->authorize('create', Work::class);

        $this->work->title = trim($this->work->title);
        $this->work->slug = str($this->work->title)->slug();
        $this->work->synopsis = trim($this->work->synopsis);
        $this->work->author_id = auth()->user()->author->id;

        $this->validate();

        if ($this->frontPage) {
            $path = $this->frontPage->store('front_pages', 'public');
            $this->work->front_page = $path;
        }

        $this->work->save();

        if ($this->work->created_at == $this->work->updated_at) {
            $this->dispatchBrowserEvent('alert', ['message' => 'Work created successfully']);
            // TODO: abrir modal preguntando si quire crear un capítulo para la obra capítulo de la obra.
        } else {
            $this->dispatchBrowserEvent('alert', ['message' => 'Work updated successfully']);
        }
    }

    public function render()
    {
        $types = Type::pluck('name', 'id');
        $states = State::pluck('name', 'id');
        $ages = Age::pluck('year', 'id');

        return view('livewire.work.save', compact('types', 'states', 'ages'));
    }
}
