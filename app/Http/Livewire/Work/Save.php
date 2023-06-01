<?php

namespace App\Http\Livewire\Work;

use App\Models\Age;
use App\Models\Genre;
use App\Models\State;
use App\Models\Type;
use App\Models\Work;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
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
    public $genresActive = [];

    public $show = false;

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
                Rule::requiredIf(!$this->work->front_page),
            ],
            'genresActive.*' => ['exists:genres,id'],
        ];
    }

    protected $validationAttributes = [
        'slug' => "title",
        'author_id' => "author",
        'type_id' => "type",
        'state_id' => "state",
        'age_id' => "age",
        'genresActive.*' => "genre",
    ];

    public function updatedGenresActive()
    {
        try {
            $this->validate([
                'genresActive.*' => ['exists:genres,id']
            ]);
        } catch (\Throwable $th) {
            $genreIds = Genre::pluck('id')->toArray();

            $this->genresActive = array_filter($this->genresActive, function ($id) use ($genreIds) {
                return in_array($id, $genreIds);
            });
        }
    }

    public function updatedFrontPage()
    {
        $this->validate([
            'frontPage' => [
                'image',
                'max:1024',
            ],
        ]);
    }

    public function updatedShow()
    {
        if (!$this->show) {
            redirect()->route('author.manage', ['slug' => auth()->user()->author->slug]);
        }
    }

    public function mount($slug = null)
    {
        if ($slug != null) {
            $work = Work::where('slug', $slug)->firstOrFail();
        }

        $this->fill([
            $this->work = $work ?? new Work(),
            $this->genresActive = $this->work->genres()->pluck('genres.id'),
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
        $isUpdate = $this->work->id;

        $isUpdate ?
            $this->authorize('update', $this->work) :
            $this->authorize('create', Work::class);

        $this->work->title = trim($this->work->title);
        $this->work->slug = str($this->work->title)->slug();
        $this->work->synopsis = trim($this->work->synopsis);
        $this->work->author_id = auth()->user()->author->id;

        $this->validate();

        DB::beginTransaction();
        try {
            if ($this->frontPage) {
                $path = $this->frontPage->storePublicly('front_pages', 's3');
                $this->work->front_page = $path;
            }

            $this->work->save();

            $this->work->genres()->sync($this->genresActive);

            DB::commit();

            if ($isUpdate) {
                $this->dispatchBrowserEvent('alert', ['message' => 'Work updated successfully']);
            } else {
                $this->dispatchBrowserEvent('alert', ['message' => 'Work created successfully']);
                $this->show = true;
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->dispatchBrowserEvent('alert', ['type' => 'danger', 'message' => 'A mistake has happened, try again later']);
        }
    }

    public function redirectToCreateChapter()
    {
        redirect()->route('chapter.create', ['workSlug' => $this->work->slug]);
    }

    public function render()
    {
        $types = Type::orderBy('name')->pluck('name', 'id');
        $states = State::orderBy('name')->pluck('name', 'id');
        $ages = Age::orderBy('year')->pluck('year', 'id');
        $genres = Genre::orderBy('name')->pluck('name', 'id');

        return view('livewire.work.save', compact('types', 'states', 'ages', 'genres'));
    }
}
