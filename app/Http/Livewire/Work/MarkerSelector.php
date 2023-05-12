<?php

namespace App\Http\Livewire\Work;

use App\Models\Marker;
use App\Models\Work;
use Livewire\Component;

class MarkerSelector extends Component
{
    public Work $work;
    public $marker;

    public function mount($id)
    {
        $this->fill([
            $this->work = Work::findOrFail($id),
            $this->marker = $this->initMarker(),
        ]);
    }

    public function initMarker()
    {
        $markedWork = $this->work->markers()->where('user_id', auth()->user()->id)->first();

        return $markedWork ? $markedWork->slug : '';
    }

    public function updatedMarker()
    {
        if ($this->marker == '') {
            $this->work->usersMarkers()->detach(auth()->user()->id);
            auth()->user()->deleteBookmark($this->work->id);
            $this->emitTo('work.show', 'setLastChapterRead', 0);
            $this->emitTo('work.show', 'refresh-work-show');
            $this->dispatchBrowserEvent('alert', ['message' => 'Work removed from library successfully']);
        } else {
            $marker = Marker::where('slug', $this->marker)->first();
            if ($marker) {
                $this->work->usersMarkers()->sync([auth()->user()->id => ['marker_id' => $marker->id]], false);
                $this->dispatchBrowserEvent('alert', ['message' => 'Work added to ' . strToLower($this->marker) . ' successfully']);
            }
        }
    }

    public function render()
    {
        $markers = Marker::all();

        return view('livewire.work.marker-selector', compact('markers'));
    }
}
