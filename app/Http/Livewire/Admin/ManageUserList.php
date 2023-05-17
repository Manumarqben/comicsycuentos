<?php

namespace App\Http\Livewire\Admin;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;

class ManageUserList extends Component
{
    use AuthorizesRequests;
    use WithPagination;

    public $showDeleteModal = false;
    public $showCreateAdminModal = false;
    public $showDeleteAdminModal = false;

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

        $this->dispatchBrowserEvent('alert', ['message' => 'User removed successfully.']);
    }

    public function redirectToAdminUser($id)
    {
        redirect()->route('admin.user', ['id' => $id]);
    }

    public function openCreateAdminModal($id)
    {
        $this->userTo = User::findOrFail($id);
        $this->name = $this->userTo->name;
        $this->showCreateAdminModal = true;
    }

    public function ascendToAdmin()
    {
        $this->authorize('create', Admin::class);

        $this->userTo->admin()->create();
        $this->showCreateAdminModal = false;
        $this->dispatchBrowserEvent('alert', ['message' => 'Admin degrade successfully.']);
    }

    public function openDeleteAdminModal($id)
    {
        $this->userTo = User::findOrFail($id);
        $this->name = $this->userTo->name;
        $this->showDeleteAdminModal = true;
    }

    public function degradeToUser()
    {
        $admin = $this->userTo->admin;

        $this->authorize('delete', $admin);

        if ($admin) {
            $admin->delete();
            $this->dispatchBrowserEvent('alert', ['message' => 'Admin degrade successfully.']);
        }
        $this->showDeleteAdminModal = false;
    }

    public function render()
    {
        $users = User::orderBy('name')->paginate(20);

        return view('livewire.admin.manage-user-list', compact('users'));
    }
}
