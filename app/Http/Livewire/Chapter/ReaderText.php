<?php

namespace App\Http\Livewire\Chapter;

use Livewire\Component;

class ReaderText extends Component
{
    public $chapterId;
    public $text;
    public $user;

    public function mount($chapterId, $text)
    {
        $this->fill([
            'chapterId' => $chapterId,
            'text' => $text,
            'user' => auth()->check() ? auth()->user()->id : 0,
        ]);
    }

    public function render()
    {
        return view('livewire.chapter.reader-text');
    }
}
