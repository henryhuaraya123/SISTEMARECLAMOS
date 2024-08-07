<?php

namespace App\Livewire;

use Livewire\Component;

class NuevaVerificacion extends Component
{

    public $open = false;
    
    public function render()
    {
        return view('livewire.nueva-verificacion');
    }
}