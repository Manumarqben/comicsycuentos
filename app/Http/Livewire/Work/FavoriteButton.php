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
        $this->favorite
            ? $this->work->usersFavorite()->detach(auth()->user()->id)
            : $this->work->usersFavorite()->attach(auth()->user()->id);
    }

    public function render()
    {
        return view('livewire.work.favorite-button');
    }
}
