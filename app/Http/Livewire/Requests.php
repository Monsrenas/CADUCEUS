<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\document_type;
use App\Models\applicant;

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

    public function save() {
        
        $vldt=$this->validate(['typeJob'=> 'required','name'=> 'required', 'email'=> 'required']);
        if (isset($vldt['field'])){
               $datos=[
                'typeJob' => $this->typeJob,
                'name'=>$this->name,
                'email'=>$this->email
               ];

                if ($this->postToEdit=="") {
                    $this->postToEdit=document_type::create($datos);

                }
                    else
                    {
                        $this->postToEdit->fill($datos);
                        $this->postToEdit->save();

                    }
            $this->open = false;
            $this->reset('postToEdit','field');
        }
    }
}
