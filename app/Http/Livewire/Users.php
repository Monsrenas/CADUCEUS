<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Mail;

class Users extends Component
{

    public $postToEdit="", $xOpen=false;
    public $typeJob="",$name, $email="", $tmpPassword="";
    public $postIdToDelete="", $nameToDelete="", $showDeleteModal=false;

    public function render()
    {
        $lista=user::where('role','<>','3')->paginate(6);
        
        return view('livewire.users', compact('lista'));
    }
    
    public function new(){
    
        $this->reset();
        $this->xOpen = true;
    }

    public function save() {
        
        $vldt=$this->validate(['typeJob'=> 'required','name'=> ['required', 'string', 'max:255'], 'email'=> ['required', 'string', 'email', 'max:255', 'unique:users']]);
        if (isset($vldt['typeJob'])){
              
                if ($this->postToEdit=="") {
                    $this->tmpPassword=Str::random(8);
                    
                    $datos=[
                            'password' => Hash::make($this->tmpPassword),
                            'name'=>$this->name,
                            'email'=>$this->email,
                            'role'=>$vldt['typeJob']
                            ];
                    $this->postToEdit=User::create($datos);
                 
                    $this->SendMail();
    
                }
                else
                    {
                        $datos=[
                            'name'=>$this->name,
                            'email'=>$this->email,
                            'role'=>$this->typeJob
                        ];
                        $user=User::find($this->postToEdit->id);
                        $user->fill($datos);
                        $user->save();
                        $this->reset();
                    }

            $this->xOpen = false;
        }
    }

    public function edit($postId){
        $this->postToEdit = User::find($postId);

        if ($this->postToEdit) {
            $this->typeJob=$this->postToEdit->role;
            $this->name=$this->postToEdit->name;
            $this->email=$this->postToEdit->email;
        }
        
        $this->xOpen = true; 
    }

    
    public function confirmDelete($postId){
        $this->nameToDelete=User::find($postId)->name;
        $this->showDeleteModal = true;
        $this->postIdToDelete=$postId;
    }

    public function deletePost(){
        if ($this->postIdToDelete) {
            $post = User::find($this->postIdToDelete);
            if ($post) {
                $post->delete(); 
            }
        }

        $this->reset('postIdToDelete','nameToDelete');
        $this->showDeleteModal = false;
    }

    public function SendMail()
    {
  
        Mail::send('emails.new-user-mail',
        array(
            'name' => $this->name,
            'email' => $this->email,
           // 'attachment' => $this->attachment,
           // 'comment' => $this->comment,
             'Password'=>$this->tmpPassword,
            ),
            function($message){
                $message->from('references@tcihospital.tc','InterHealthCanada');
                $message->to($this->email, $this->name )->subject('You have been registered as a new user in the CADUCEUS system');
            }
        );

        $this->reset();
    }
}
