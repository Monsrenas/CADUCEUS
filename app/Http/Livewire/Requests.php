<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\applicant;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class Requests extends Component
{

    public $postToEdit="", $xOpen=false;
    public $typeJob="",$name, $email="";

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
        if (isset($vldt['typeJob'])){
               $password=Str::random(8);
               $datos=[
                'password' => Hash::make($password),
                'name'=>$this->name,
                'email'=>$this->email
               ];

                if ($this->postToEdit=="") {
                    $this->postToEdit=User::create($datos);
                    $applicant=applicant::create([
                                                    'user_id' => $this->postToEdit->id,
                                                    'type_of_job'=>$this->typeJob,
                                                    'process_state'=>"0"
                                                ]);
                }
                    else
                    {
                        $this->postToEdit->fill($datos);
                        $this->postToEdit->save();

                    }
            $this->open = false;
            $this->reset('postToEdit');
        }
    }
}
