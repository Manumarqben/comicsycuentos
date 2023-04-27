<?php

namespace App\Http\Livewire\Chapter;

use App\Models\Chapter;
use App\Models\Work;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Save extends Component
{
    use AuthorizesRequests;

    public Work $work;
    public Chapter $chapter;

    public $contentType;
    public $chapterText;
    public $chapterImages;

    protected function rules()
    {
        return  $rules = [
            'chapter.number' => [
                'integer',
                'min:0',
                Rule::unique('chapters', 'number')->where('work_id', $this->work->id)->ignore($this->chapter->id),
                'required',
            ],
            'chapter.title' => [
                'string',
                'max:255',
                'required',
            ],
            'chapterText' => [
                'required_if:contentType,text',
            ],
            'chapterImages' => [
                'required_if:contentType,image',
            ],
            'chapterImages.*' => [
                'image',
                'max:1024',
            ],
        ];
    }

    public function updatingChapter()
    {
    }

    public function mount($workSlug, $chapterNumber = null)
    {
        $this->work = Work::where('slug', $workSlug)->firstOrFail();
        if ($chapterNumber) {
            $chapter = $this->work->chapters()->where('number', $chapterNumber)->firstOrFail();
        }
        $this->fill([
            $this->chapter = $chapter ?? new Chapter(),
            $this->contentType = '',
            $this->chapterText = '',
            $this->chapterImages = [],
        ]);
    }

    public function submit()
    {
        $this->chapter->title = trim($this->chapter->title);
        $this->chapter->work_id = $this->work->id;

        $this->authorize('create', $this->chapter);

        $this->validate();

        $this->chapter->save();

        $this->dispatchBrowserEvent('alert', ['message' => 'Chapter created successfully']);
    }

    public function render()
    {
        $this->authorize('create', $this->work);
        return view('livewire.chapter.save');
    }
}
