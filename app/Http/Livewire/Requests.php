<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\applicant;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Mail;

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
              
                if ($this->postToEdit=="") {
                    $password=Str::random(8);
                    $datos=[
                            'password' => Hash::make($password),
                            'name'=>$this->name,
                            'email'=>$this->email,
                            'role'=>'3'
                            ];
                    $this->postToEdit=User::create($datos);
                    $applicant=applicant::create([
                                                    'user_id' => $this->postToEdit->id,
                                                    'type_of_job'=>$this->typeJob,
                                                    'process_state'=>"0"
                                                ]);
                 $this->SendMail();
                }
                else
                    {
                        $datos=[
                            'name'=>$this->name,
                            'email'=>$this->email,
                        ];
                        $this->postToEdit->fill(['type_of_job'=>$this->typeJob]);
                        $this->postToEdit->save();

                        $user=User::find($this->postToEdit->user_id);
                        $user->fill($datos);
                        $user->save();

                    }

            $this->xOpen = false;
            $this->reset();
        }
    }

    public function edit($postId){
        $this->postToEdit = applicant::find($postId);

        if ($this->postToEdit) {
            $this->typeJob=$this->postToEdit->type_of_job;
            $user=User::find($this->postToEdit->user_id);
            $this->name=$user->name;
            $this->email=$user->email;
        }
        
        $this->xOpen = true; 

    }


    public function SendMail()
    {
  
        Mail::send('emails.applicant-mail',
        array(
            'name' => $this->name,
            'email' => $this->email,
           // 'attachment' => $this->attachment,
           // 'comment' => $this->comment,
            ),
            function($message){
                $message->from('references@tcihospital.tc','InterHealthCanada');
                $message->to($this->email, $this->name )->subject('Start of the accreditation process');
            }
        );
    }
}
