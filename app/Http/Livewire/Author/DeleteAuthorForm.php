<?php

namespace App\Http\Livewire\Author;

use App\Models\Author;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class DeleteAuthorForm extends Component
{
    use AuthorizesRequests;

    public Author $author;
    public $show;

    public function mount($author)
    {
        $this->fill([
            'author' => $author,
            'show' => false,
        ]);
    }

    public function delete()
    {
        $this->authorize('delete', $this->author);

        DB::beginTransaction();
        try {
            Storage::disk('s3')->delete($this->author->profilePhoto->path);
            $this->author->delete();
            DB::commit();
            return redirect()->to('/');
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->dispatchBrowserEvent('alert', ['type' => 'danger', 'message' => 'A mistake has happened, try again later']);
        }
    }

    public function render()
    {
        return view('livewire.author.delete-author-form');
    }
}
