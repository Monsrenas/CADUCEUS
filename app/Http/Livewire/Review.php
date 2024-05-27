<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\applicant;
use App\Models\documents;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Mail;

class Review extends Component
{

    public $postToEdit="", $xOpen=false;
    public $typeJob="",$name, $email="", $tmpPassword="";
    public $doc_list=[], $nameToEdit="",$nameToDelete="", $showDeleteModal=false,
           $docToView=[];

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
        $this->doc_list=$this->postToEdit->documents;
        $this->nameToEdit=$this->postToEdit->user->name;
    }

    public function ViewDoc($postId){
        $this->docToView = documents::find($postId);

        $this->docToView->file=asset('storage/'.$this->docToView->file);
        $this->xOpen = true; 

    }

    public function closeDetail()
    {
        $this->reset();
    }

}
