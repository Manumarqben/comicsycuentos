<?php

namespace App\Http\Livewire\Work;

use App\Models\Work;
use Livewire\Component;

class Show extends Component
{
    public Work $work;

    public function mount($slug)
    {
        $this->fill([
            $this->work = Work::where('slug', $slug)->firstOrFail(),
        ]);
    }

    public function render()
    {
        return view('livewire.work.show');
    }
}
