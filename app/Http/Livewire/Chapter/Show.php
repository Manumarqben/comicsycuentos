<?php

namespace App\Http\Livewire\Chapter;

use App\Models\Chapter;
use Livewire\Component;

class Show extends Component
{
    public $chapter;

    public function mount($workSlug, $chapterNumber)
    {
        $this->fill([
            $this->chapter = Chapter::where('number', $chapterNumber)
                ->whereHas('work', function ($query) use ($workSlug) {
                    $query->where('slug', $workSlug);
                })
                ->firstOrFail(),
        ]);
    }
    public function render()
    {
        return view('livewire.chapter.show');
    }
}
