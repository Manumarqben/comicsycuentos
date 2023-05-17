<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;

class ManageUserList extends Component
{
    use AuthorizesRequests;
    use WithPagination;

    public $showDeleteModal = false;

    public User $userTo;
    public $name = '';

    public function openDeleteModal($id)
    {
        $this->userTo = User::findOrFail($id);
        $this->name = $this->userTo->name;
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        $this->authorize('manageUsers', Admin::class);

        $this->userTo->delete();

        $this->showDeleteModal = false;

        $this->dispatchBrowserEvent('alert', ['message' => 'Author removed successfully.']);
    }

    public function redirectToAdminUser($id)
    {
        redirect()->route('admin.user', ['id' => $id]);
    }

    public function render()
    {
        $users = User::orderBy('name')->paginate(20);

        return view('livewire.admin.manage-user-list', compact('users'));
    }
}
