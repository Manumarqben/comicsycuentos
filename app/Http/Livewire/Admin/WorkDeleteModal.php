<?php

namespace App\Http\Livewire\Admin;

use App\Models\Admin;
use App\Models\Work;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class WorkDeleteModal extends Component
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
        $this->authorize('manageWorks', Admin::class);

        $this->work->delete();

        $this->emit('refresh-admin-manege-author-works');
        $this->dispatchBrowserEvent('alert', ['message' => 'Work deleted successfully']);
        $this->show = false;
    }

    public function open($id)
    {
        $this->authorize('manageWorks', Admin::class);

        $temp = Work::where('id', $id)->firstOrFail();

        if ($temp) {
            $this->work = $temp;
            $this->show = true;
        }
    }

    public function render()
    {
        return view('livewire.admin.work-delete-modal');
    }
}
