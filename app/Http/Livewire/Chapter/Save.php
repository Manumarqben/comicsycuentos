<?php

namespace App\Http\Livewire\Chapter;

use App\Models\Chapter;
use App\Models\Work;
use Livewire\Component;

class Save extends Component
{
    public Work $work;
    public Chapter $chapter;
    
    public $contentType;
    public $chapterText;
    public $chapterImages;



    protected function rules()
    {
        return  $rules = [
            'chapter.number' => [
                'required',
            ],
            'chapter.title' => [
                'required',
            ],
            'chapterText' => [

            ],
            'chapterImages.*' => [

            ],
        ];
    }

    public function mount($workSlug, $chapterNumber = null)
    {
        $this->work = Work::where('slug', $workSlug)->firstOrFail();
        if ($chapterNumber) {
            $chapter = $this->work->chapters()->where('number', $chapterNumber)->firstOrFail();
        }
        $this->fill([
            $this->chapter = $chapter ?? new Chapter(),
        ]);
    }

    public function submit()
    {
        dd('hola');
    }

    public function render()
    {
        return view('livewire.chapter.save');
    }
}
