<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\applicant;
use App\Models\documents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Mail;

class Review extends Component
{

    public $postToEdit="", $xOpen=false;
    public $typeJob="",$name, $email="", $tmpPassword="";
    public $doc_list=[], $nameToEdit="",$nameToDelete="", $showDeleteModal=false;

    public function render()
    {
        $lista=applicant::paginate(6);
        $list_doc=$this->doc_list;
        return view('livewire.review', compact('lista','list_doc'));
    }
    
    public function new(){
    
        $this->reset('postToEdit');
        $this->xOpen = true;
    }

    public function Applicant_details($id)
    {
        $this->postToEdit=applicant::find($id);
        $this->xOpen = true; 
        $this->doc_list=$this->postToEdit->documents;
        $this->nameToEdit=$this->postToEdit->user->name;
    }

    public function edit($postId){
        $this->postToEdit = applicant::find($postId);

        if ($this->postToEdit) {
            $this->typeJob=$this->postToEdit->type_of_job;
            $user=User::find($this->postToEdit->user_id);
            $this->nameToEdit=$user->name;
             dd($this->nameToEdit);
        }
        
        $this->xOpen = true; 

    }

}
