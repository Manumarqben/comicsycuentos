<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Validation\Rule;
use Livewire\Component;

class ManageUserInformationForm extends Component
{
    use AuthorizesRequests;

    public User $user;

    protected function rules()
    {
        return $rules = [
            'user.name' => [
                'required',
                'string',
                'max:255'
            ],
            'user.birthdate' => [
                'nullable',
                'date',
                'date_format:Y-m-d',
                'before_or_equal:today'
            ],
            'user.email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($this->user->id)
            ],
        ];
    }

    public function mount($user)
    {
        $this->fill([
            'user' => $user,
        ]);
    }

    public function updateProfileInformation()
    {
        $this->authorize('manageUsers', Admin::class);

        $this->user->name = trim($this->user->name);

        $this->validate();

        $this->user->save();

        $this->dispatchBrowserEvent('alert', ['message' => 'Updated successfully']);
    }

    public function render()
    {
        return view('livewire.admin.manage-user-information-form');
    }
}
