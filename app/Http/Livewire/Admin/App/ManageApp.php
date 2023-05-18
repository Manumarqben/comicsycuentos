<?php

namespace App\Http\Livewire\Admin\App;

use Livewire\Component;

class ManageApp extends Component
{
    public $manage = 'genres';

    public function render()
    {
        return view('livewire.admin.app.manage-app');
    }
}
