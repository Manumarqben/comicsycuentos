<?php

namespace App\Http\Livewire\Chapter;

use App\Models\Chapter;
use App\Models\Work;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;
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
                'in:text,image',
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
        }

        $this->fill([
            $this->chapterImages = isset($chapter) ? $chapter->images->pluck('url', 'order')->toArray() : [],
            $this->chapterText = $chapter->text->content ?? '',
            $this->chapter = $chapter ?? new Chapter(),
            $this->contentType = isset($chapter) ? $chapter->type : '',
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
        if ($this->chapter->id) {
            $this->authorize('update', $this->chapter);
        } else {
            $this->chapter->work_id = $this->work->id;
            $this->authorize('create', $this->chapter);

            if ($this->chapter->type != $this->contentType) {
                if ($this->chapter->type == 'text') {
                    $this->chapter->text()->delete();
                } elseif ($this->chapter->type == 'image') {
                    $this->chapter->images()->delete();
                }
            }
        }

        $this->chapter->title = trim($this->chapter->title);
        $this->chapter->type = $this->contentType;

        $this->validate();

        $this->chapter->save();

        if ($this->contentType == 'text') {
            $this->saveText();
        }

        if ($this->contentType == 'image') {
            $this->saveImages();
        }

        if ($this->chapter->created_at == $this->chapter->updated_at) {
            $this->dispatchBrowserEvent('alert', ['message' => 'Chapter created successfully']);
        } else {
            $this->dispatchBrowserEvent('alert', ['message' => 'Chapter updated successfully']);
        }
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

            $previousImage = $this->chapter->images()->where('order', $key)->first();
            if ($previousImage) {
                Storage::delete($previousImage->url);
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
        if (is_string($this->chapterImages[$key])) {
            Storage::delete($this->chapterImages[$key]);
        }
        unset($this->chapterImages[$key]);
    }

    public function render()
    {
        $this->authorize('create', $this->work);
        return view('livewire.chapter.save');
    }
}