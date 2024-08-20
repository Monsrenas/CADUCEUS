<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Traits\Tools;
use App\Models\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Mail;

class Users extends Component
{
    use Tools;
    use WithPagination;


    public $xAccess=[]; 
    public $typeJob="",$name, $email="", $tmpPassword="";
    public $postIdToDelete="", $nameToDelete="", $showDeleteModal=false,
           $xGroup="", $xName="";
    public  $Lvl3d=[[],["Chief of Medical Services","Chief of Clinical Service",
    "Chief of Allied Services"],
    ["Medical Services","Clinical Service",
    "Allied Services","Human Resources"]];

    public function render()
    {
        $xGroup=$this->xGroup;   
        $xName=$this->xName;

        $lista=user::where('role','<>','3')->when($this->xGroup<>'', function ($query) use ($xGroup) {
            $query->whereJsonContains('access->9', $xGroup);
        })->when(($this->xName<>""), function($q) use ($xName){
            return $q->where('name', 'like','%'.$xName.'%');
          })->paginate(6);
        
        return view('livewire.users', compact('lista'));
    }
    
    public function new(){
    
        $this->reset();
        $this->xOpen = true;
    }

    public function save() {
                
                if (!$this->postToEdit) {
                    $vldt=$this->validate(['typeJob'=> 'required','name'=> ['required', 'string', 'max:255'], 'email'=> ['required', 'string', 'email', 'max:255', 'unique:users']]);
                    $this->tmpPassword=Str::random(8);
                    
                    $datos=[
                            'password' => Hash::make($this->tmpPassword),
                            'name'=>$this->name,
                            'email'=>$this->email,
                            'role'=>$vldt['typeJob'],
                            'access'=>json_encode($this->xAccess)
                            ];
                    $this->postToEdit=User::create($datos);
                 
                    $this->SendMail(0);

                    $this->dispatchBrowserEvent('message', [
                        'body' => 'The user has been created successfully. An email was sent with the information and the access link.',
                        'timeout' => 6000 ]);
            
    
                }
                else
                {
                    if ($this->postToEdit->email<>$this->email) {
                        $vldt=$this->validate(['typeJob'=> 'required','name'=> ['required', 'string', 'max:255'], 'email'=> ['required', 'string', 'email', 'max:255', 'unique:users']]);
                    }
                                            
                    $datos=[
                        'name'=>$this->name,
                        'email'=>$this->email,
                        'role'=>$this->typeJob,
                        'access'=>json_encode($this->xAccess)
                    ];
                    $this->postToEdit->fill($datos);
                    $this->postToEdit->save();
                    $this->reset();

                    $this->dispatchBrowserEvent('message', [
                        'body' => 'The information was successfully updated',
                        'timeout' => 4000 ]);
                }
                
            $this->xOpen = false;
        
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

    public function updatedTypeJob()
    {
        $this->reset('xAccess');
    }

}
