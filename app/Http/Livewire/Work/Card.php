<?php

namespace App\Http\Livewire\Work;

use App\Models\Work;
use Livewire\Component;

class Card extends Component
{
    public Work $work;

    public function mount($work)
    {
        $this->fill([
            $this->work = $work,
        ]);
    }

    public function redirectToWork()
    {
        redirect()->route('work.show', $this->work->slug);
    }

    public function render()
    {
        return view('livewire.work.card');
    }
}
