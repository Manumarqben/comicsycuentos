<?php

namespace App\Http\Livewire\Work;

use App\Models\AgeRange;
use App\Models\Work;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class ListWorks extends Component
{
    use WithPagination;

    public $author;
    public $state;
    public $type;
    public $age;
    public $marker;
    public $search;

    public $genres;
    public $urlGenres;

    public $sortBy = 'title';
    public $sortDirection = 'asc';

    protected $queryString = [
        'state' => ['except' => ''],
        'type' => ['except' => ''],
        'age' => ['except' => ''],
        'marker' => ['except' => 'following'],
        'search' => ['except' => ''],
        'urlGenres' => ['except' => '', 'as' => 'genres'],
        'sortBy' => ['except' => 'title'],
        'sortDirection' => ['except' => 'asc', 'as' => 'sortDirection'],
    ];

    protected $listeners = [
        'setState',
        'setType',
        'setAge',
        'setMarker',
        'setSearch',
        'setGenres',
        'setSort',
        'resetPagination',
    ];

    public function mount()
    {
        if ($this->urlGenres) {
            $this->genres = explode(',', $this->urlGenres);
        }
    }

    public function resetPagination()
    {
        $this->resetPage();
    }

    public function setState($state)
    {
        $this->state = $state;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function setAge($age)
    {
        $this->age = $age;
    }

    public function setMarker($marker)
    {
        $this->marker = $marker;
    }

    public function setSearch($search)
    {
        $this->search = $search;
    }

    public function setGenres($genres)
    {
        $this->genres = $genres;
        $this->urlGenres = implode(',', $genres);
    }

    public function setSort($by = 'title', $direction = 'asc')
    {
        $this->sortBy = $by;
        $this->sortDirection = $direction;
    }

    private function childrenFilter()
    {
        if (auth()->check()) {
            $age = Carbon::parse(auth()->user()->birthdate)->age;
            if ($age >= 18) {
                return Work::query();
            }
        }
        return Work::whereHas('age', function ($query) {
            $query->where('year', '<', 18);
        });
    }

    public function render()
    {
        $works = $this->childrenFilter();

        if ($this->marker) {
            if ($this->marker === 'favorite') {
                $works->whereHas('usersFavorite', function ($query) {
                    $query->where('user_id', auth()->user()->id);
                });
            } else {
                $works->whereHas('markers', function ($query) {
                    $query->where('slug', $this->marker)
                        ->where('user_id', auth()->user()->id);
                });
            }
        }

        if ($this->author) {
            $works->where('author_id', $this->author);
        }

        if ($this->state) {
            $works->whereHas('state', function ($query) {
                $query->where('slug', $this->state);
            });
        }

        if ($this->type) {
            $works->whereHas('type', function ($query) {
                $query->where('slug', $this->type);
            });
        }

        if ($this->age != '') {
            $range = AgeRange::where('slug', $this->age)->first();
            if ($range) {
                $works->whereBetween('age_id', [$range->age_min, $range->age_max]);
            } elseif (is_numeric($this->age)) {
                $works->whereHas('age', function ($query) {
                    $query->where('year', $this->age);
                });
            }
        }

        if ($this->search) {
            $works->whereRaw('lower(title) like lower(?)', '%' . $this->search . '%');
        }

        if ($this->genres) {
            $works->whereHas('genres', function ($query) {
                $query->whereIn('slug', $this->genres);
            }, '>=', count($this->genres));
        }

        $works->orderBy($this->sortBy, $this->sortDirection);

        $works = $works->paginate(12);

        return view('livewire.work.list-works', compact('works'));
    }
}
