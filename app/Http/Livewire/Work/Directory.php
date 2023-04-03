<?php

namespace App\Http\Livewire\Work;

use App\Models\Work;
use Livewire\Component;

class Directory extends Component
{
    public function render()
    {
        $works = Work::all();
        return view('livewire.work.directory', compact('works'));
    }
}
