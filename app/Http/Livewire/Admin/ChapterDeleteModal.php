<?php

namespace App\Http\Livewire\Admin;

use App\Models\Admin;
use App\Models\Chapter;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class ChapterDeleteModal extends Component
{
    use AuthorizesRequests;

    public Chapter $chapter;
    public $show;

    protected $listeners = [
        'open',
    ];

    public function mount()
    {
        $this->fill([
            'show' => false,
        ]);
    }

    public function delete()
    {
        $this->authorize('manageChapters', Admin::class);

        $chapterNumberThatWillBeDeleted = $this->chapter->number;
        $work_id = $this->chapter->work_id;

        $prueba = Storage::deleteDirectory('images/' . $this->chapter->work->id . '/' . $this->chapter->id);

        $this->chapter->delete();

        $chapters = Chapter::where('work_id', $work_id)
            ->where('number', '>', $chapterNumberThatWillBeDeleted);

        $chapters->decrement('number', 1);

        $this->emit('refresh-admin-manege-author-works');
        $this->dispatchBrowserEvent('alert', ['message' => 'Chapter deleted successfully']);
        $this->show = false;
    }

    public function open($id)
    {
        $this->authorize('manageChapters', Admin::class);

        $temp = Chapter::where('id', $id)->firstOrFail();

        if ($temp) {
            $this->chapter = $temp;
            $this->show = true;
        }
    }

    public function render()
    {
        return view('livewire.admin.chapter-delete-modal');
    }
}
