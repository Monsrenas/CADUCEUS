<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Requests extends Component
{

    public $postToEdit="", $xOpen=false, $typeJob="";
    public function render()
    {
        return view('livewire.requests');
    }

    public function new(){
    
        $this->reset('postToEdit');
        $this->xOpen = true;
    }
}
