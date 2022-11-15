<?php

namespace App\Http\Livewire\Componentes;

use Livewire\Component;

class BtnCrud extends Component
{
    public $recurso = '';
    public $accion = '';
    public $parametros;
    public $color = 'white';
    public $slot = '';
    public $ruta;

    public function mount() 
    {
        $this->ruta = $this->recurso . '.' . $this->accion;
    }

    public function render()
    {
        return view('livewire.componentes.btn-crud');
    }
}
