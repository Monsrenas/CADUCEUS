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
        $lista=applicant::paginate(6);
        return view('livewire.requests', compact('lista'));
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
                'email'=>$this->email,
                'role'=>'3'
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
            $this->xOpen = false;
            $this->reset();
        }
    }

    public function SendMail() {
        $passingDataToView = 'Simple Mail Send In Laravel!';
        $data["email"] = 'test@mail.com';
        $data["title"] = "Mail Testing";

        Mail::send('mail.simplemail', ['passingDataToView'=> $passingDataToView], function ($message) use ($data){
            $message->to($data["email"],'John Doe');
            $message->subject($data["title"]);
        });;

        return 'Mail Sent';
    }
}
