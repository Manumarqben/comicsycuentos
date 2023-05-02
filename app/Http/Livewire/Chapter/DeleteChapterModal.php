<?php

namespace App\Http\Livewire\Chapter;

use App\Models\Chapter;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
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

        $this->chapter->delete();

        $this->emit('refresh-manege-author-works');
        $this->dispatchBrowserEvent('alert', ['message' => 'Chapter deleted successfully']);
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
