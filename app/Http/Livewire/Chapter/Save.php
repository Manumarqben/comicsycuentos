<?php

namespace App\Http\Livewire\Chapter;

use App\Models\Chapter;
use App\Models\Work;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class Save extends Component
{
    use AuthorizesRequests;
    use WithFileUploads;

    public Work $work;
    public Chapter $chapter;

    public $contentType;
    public $chapterText;
    public $chapterImages;

    public $validImages;

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
            'contentType' => [
                'required',
            ],
        ];
    }

    protected $messages = [
        'contentType.required' => 'You need to select a valid content type.',
    ];

    public function mount($workSlug, $chapterNumber = null)
    {
        $this->work = Work::where('slug', $workSlug)->firstOrFail();

        if ($chapterNumber) {
            $chapter = $this->work->chapters()->where('number', $chapterNumber)->firstOrFail();

            if ($chapter->text) {
                $this->contentType = 'text';
            } elseif ($chapter->images) {
                $this->contentType = 'image';
            }
        }

        $this->fill([
            $this->chapter = $chapter ?? new Chapter(),
            $this->chapterText = $chapter->text->content ?? '',
            $this->chapterImages = [],
            $this->validImages = true,
        ]);
    }

    public function submit()
    {
        $this->chapter->title = trim($this->chapter->title);
        $this->chapter->work_id = $this->work->id;

        $this->authorize('create', $this->chapter);

        $this->validate();

        $this->chapter->save();

        if ($this->contentType == 'text') {
            $this->saveText();
        }

        if ($this->contentType == 'image') {
            $this->saveImages();
        }

        $this->dispatchBrowserEvent('alert', ['message' => 'Chapter created successfully']);
    }

    private function saveText()
    {
        $this->chapter->text()->updateOrCreate(
            ['chapter_id' => $this->chapter->id],
            ['content' => $this->chapterText]
        );
    }

    private function saveImages()
    {
        $storage = 'images/' . $this->chapter->work->id . '/' . $this->chapter->id;
        foreach ($this->chapterImages as $image) {
            $order = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $path = $image->store($storage, 'public');

            $this->chapter->images()->updateOrCreate([
                'chapter_id' => $this->chapter->id,
                'order' => $order,
                'url' => $path,
            ]);
        }
    }

    public function render()
    {
        $this->authorize('create', $this->work);
        return view('livewire.chapter.save');
    }
}
