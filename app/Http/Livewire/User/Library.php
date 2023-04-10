<?php

namespace App\Http\Livewire\User;

use Livewire\Component;

class Library extends Component
{
    public $marker = 'following';

    protected $queryString = [
        'marker' => ['except' => 'following'],
    ];

    public function render()
    {
        return view('livewire.user.library');
    }
}
