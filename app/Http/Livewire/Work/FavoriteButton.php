<?php

namespace App\Http\Livewire\Work;

use App\Models\Work;
use Livewire\Component;

class FavoriteButton extends Component
{
    public $work;

    public function mount($id)
    {
        $this->fill([
            $this->work = Work::findOrFail($id),
        ]);
    }

    public function getFavoriteProperty()
    {
        return $this->work->usersFavorite()->where('user_id', auth()->user()->id)->first();
    }

    public function fav()
    {
        if ($this->favorite) {
            $this->work->usersFavorite()->detach(auth()->user()->id);
            $this->dispatchBrowserEvent('alert', ['message' => 'Work removed from favorites successfully']);
        } else {
            $this->work->usersFavorite()->attach(auth()->user()->id);
            $this->dispatchBrowserEvent('alert', ['message' => 'Work added to favorites successfully']);
        }
    }

    public function render()
    {
        return view('livewire.work.favorite-button');
    }
}
