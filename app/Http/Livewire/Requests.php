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

    public $postToEdit="", $xOpen=false, $xAccess=[];
    public $typeJob="",$name, $email="", $tmpPassword="";
    public $postIdToDelete="", $nameToDelete="", $showDeleteModal=false;

    public function render()
    {
        $lista=applicant::paginate(6);
        
        return view('livewire.requests', compact('lista'));
    }
    
    public function new(){
    
        $this->reset();
        $this->xOpen = true;
    }

    public function save() {
              
                if (!$this->postToEdit) {
                    $vldt=$this->validate(['typeJob'=> 'required','name'=> ['required', 'string', 'max:255'],
                    'xAccess'=> 'required',     
                    'email'=> ['required', 'string', 'email', 'max:255', 'unique:users']]);
                    $this->tmpPassword=Str::random(8);
                    
                    $datos=[
                            'password' => Hash::make($this->tmpPassword),
                            'name'=>$this->name,
                            'email'=>$this->email,
                            'role'=>'3',
                            'access'=>json_encode($this->xAccess),
                            ];
                    $this->postToEdit=User::create($datos);
                    $applicant=applicant::create([
                                                    'user_id' => $this->postToEdit->id,
                                                    'type_of_job'=>$this->typeJob,
                                                    'process_state'=>"0"
                                                ]);
                 
                 $this->SendMail();
                 $this->dispatchBrowserEvent('message', [
                    'body' => 'Applicant information has been registered. An email was sent to the applicant with the information to access the platform.',
                    'timeout' => 6000 ]);
                }
                else
                    {
                        if ($this->postToEdit->user->email<>$this->email) {
                            $vldt=$this->validate(['typeJob'=> 'required','name'=> ['required', 'string', 'max:255'],
                            'xAccess'=> 'required',
                            'email'=> ['required', 'string', 'email', 'max:255', 'unique:users']]);
                        }

                        $datos=[
                            'name'=>$this->name,
                            'email'=>$this->email,
                            'access'=>json_encode($this->xAccess)
                        ];
                        $this->postToEdit->fill(['type_of_job'=>$this->typeJob]);
                        $this->postToEdit->save();

                        $user=User::find($this->postToEdit->user_id);
                        $user->fill($datos);
                        $user->save();
                        $this->reset();

                        $this->dispatchBrowserEvent('message', [
                            'body' => 'Applicant information was successfully updated',
                            'timeout' => 6000 ]);
                    }

            $this->xOpen = false;
            
        
    }

    public function edit($postId){
        $this->postToEdit = applicant::find($postId);

        if ($this->postToEdit) {
            $this->typeJob=$this->postToEdit->type_of_job;
            $user=User::find($this->postToEdit->user_id);
            $this->name=$user->name;
            $this->email=$user->email;
            $this->xAccess=json_decode($user->access, true);
        }
        
        $this->xOpen = true; 

    }

    
    public function confirmDelete($postId){
        $this->postIdToDelete = $postId;
        $PtoDel= applicant::find($postId);
        $this->nameToDelete=User::find($PtoDel->user_id)->name;
        $this->showDeleteModal = true;
    }

    public function deletePost(){
        if ($this->postIdToDelete) {
            $post = applicant::find($this->postIdToDelete);
            if ($post) {
                $user=User::find($post->user_id);
                $post->delete();
                $user->delete();
            }
        }

        $this->reset('postIdToDelete','nameToDelete');
        $this->showDeleteModal = false;
    }

    public function SendMail()
    {
  
        Mail::send('emails.applicant-mail',
        array(
            'name' => $this->name,
            'email' => $this->email,
           // 'attachment' => $this->attachment,
           // 'comment' => $this->comment,
             'Password'=>$this->tmpPassword,
            ),
            function($message){
                $message->from('references@tcihospital.tc','InterHealthCanada');
                $message->to($this->email, $this->name )->subject('Start of the accreditation process');
            }
        );

        $this->reset();
    }
}
