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
    public $temporalImages;

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
            'contentType' => [
                'required',
            ],
        ];
    }

    protected $messages = [
        'contentType.required' => 'You need to select a valid content type.',
    ];

    public function mount($workSlug, $chapterId = null)
    {
        $this->work = Work::where('slug', $workSlug)->firstOrFail();

        if ($chapterId) {
            $chapter = $this->work->chapters()->where('id', $chapterId)->firstOrFail();

            // TODO: añadir campo tipo al capítulo.
            if ($chapter->text) {
                $this->contentType = 'text';
            } elseif ($chapter->images) {
                $this->contentType = 'image';
            }
        }

        $this->fill([
            $this->chapterImages = isset($chapter) ? $chapter->images->pluck('url', 'order')->toArray() : [],
            $this->chapterText = $chapter->text->content ?? '',
            $this->chapter = $chapter ?? new Chapter(),
        ]);
    }

    public function updatedTemporalImages()
    {
        $this->validate([
            'temporalImages.*' => [
                'image',
                'max:1024',
            ],
        ]);
        foreach ($this->temporalImages as $image) {
            $key = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            if (ctype_digit($key)) {
                $this->chapterImages[$key] = $image;
            } else {
                $this->addError('temporalImages.*', 'The name of an image does not correspond to a correct page number.');
            }
        }
    }

    public function submit()
    {
        $this->authorize('create', $this->chapter);

        $this->chapter->title = trim($this->chapter->title);
        $this->chapter->work_id = $this->work->id;

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
        foreach ($this->chapterImages as $key => $image) {
            if (is_string($image)) {
                continue;
            }
            $path = $image->store($storage, 'public');

            $this->chapter->images()->updateOrCreate(
                [
                    'chapter_id' => $this->chapter->id,
                    'order' => $key,
                ],
                [
                    'url' => $path,
                ]
            );
        }
    }

    public function deleteImage($key)
    {
        unset($this->chapterImages[$key]);
    }

    public function render()
    {
        $this->authorize('create', $this->work);
        return view('livewire.chapter.save');
    }
}
