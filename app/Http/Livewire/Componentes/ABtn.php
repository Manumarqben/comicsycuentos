<?php

namespace App\Http\Livewire\Componentes;

use Livewire\Component;

class ABtn extends Component
{
    public $ruta;
    public $color;
    public $slot = '';

    public function render()
    {
        return view('livewire.componentes.a-btn');
    }
}
