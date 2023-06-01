<?php

namespace App\Http\Livewire\Work;

use App\Models\Work;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
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

        DB::beginTransaction();
        try {
            Storage::disk('s3')->delete($this->work->front_page);
            $this->work->delete();

            DB::commit();

            $this->emit('refresh-manege-author-works');
            $this->dispatchBrowserEvent('alert', ['message' => 'Work deleted successfully']);
            $this->show = false;
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->dispatchBrowserEvent('alert', ['type' => 'danger', 'message' => 'A mistake has happened, try again later']);
        }
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
