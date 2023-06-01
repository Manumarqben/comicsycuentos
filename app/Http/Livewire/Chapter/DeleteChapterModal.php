<?php

namespace App\Http\Livewire\Chapter;

use App\Models\Chapter;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class DeleteChapterModal extends Component
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
        $this->authorize('delete', $this->chapter);

        $chapterNumberThatWillBeDeleted = $this->chapter->number;
        $work_id = $this->chapter->work_id;
        DB::beginTransaction();
        try {
            Storage::disk('s3')->deleteDirectory('images/' . $work_id . '/' . $this->chapter->id);
            $this->chapter->delete();
            $chapters = Chapter::where('work_id', $work_id)
                ->where('number', '>', $chapterNumberThatWillBeDeleted);
            $chapters->decrement('number', 1);
            DB::commit();

            $this->emit('refresh-manege-author-works');
            $this->dispatchBrowserEvent('alert', ['message' => 'Chapter deleted successfully']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->dispatchBrowserEvent('alert', ['type' => 'danger', 'message' => 'A mistake has happened, try again later']);
        }

        $this->show = false;
    }

    public function open($id)
    {
        $temp = Chapter::where('id', $id)->firstOrFail();

        $this->authorize('delete', $temp);

        if ($temp) {
            $this->chapter = $temp;
            $this->show = true;
        }
    }

    public function render()
    {
        return view('livewire.chapter.delete-chapter-modal');
    }
}
