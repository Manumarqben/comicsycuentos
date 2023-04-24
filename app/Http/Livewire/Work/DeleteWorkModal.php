<?php

namespace App\Http\Livewire\Work;

use App\Models\Work;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class DeleteWorkModal extends Component
{
    use AuthorizesRequests;

    public Work $work;
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
        $this->authorize('delete', $this->work);

        $this->work->delete();

        $this->dispatchBrowserEvent('alert', ['message' => 'Work deleted successfully']);
        $this->show = false;
    }

    public function open($id)
    {
        $temp = Work::where('id', $id)->firstOrFail();

        $this->authorize('delete', $temp);

        if ($temp) {
            $this->work = $temp;
            $this->show = true;
        }
    }

    public function render()
    {
        return view('livewire.work.delete-work-modal');
    }
}
