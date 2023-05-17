<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;

class ManageUser extends Component
{
    public User $user;

    public function mount($id)
    {
        $this->fill([
            'user' => User::findOrFail($id),
        ]);
    }

    public function render()
    {
        return view('livewire.admin.manage-user');
    }
}
