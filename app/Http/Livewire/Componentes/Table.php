<?php

namespace App\Http\Livewire\Componentes;

use Livewire\Component;

class Table extends Component
{
    public $elementos;
    public $recurso;
    public $acciones = true;

    public function render()
    {
        return view('livewire.componentes.table');
    }
}
