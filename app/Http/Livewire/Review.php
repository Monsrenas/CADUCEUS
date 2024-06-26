<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\applicant;
use App\Models\document_type;
use App\Models\documents;
use App\Models\comments;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Mail;

class Review extends Component
{

    public $postToEdit="", $xOpen=false;
    public $typeJob="",$name, $email="", $tmpPassword="";
    public $doc_list=[], $nameToEdit="",$nameToDelete="", $showDeleteModal=false,
           $docToView=[], $field="", $rvwStart=false, $xComment="",$xGroup="";

    public function render()
    {
        $xGroup=$this->xGroup;   
         
        $lista=User::whereHas('applicant')->when($this->xGroup<>'', function ($query) use ($xGroup) {
            $query->whereJsonContains('access->9', $xGroup);
        })->paginate(6);

     
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
        //$this->doc_list=$this->postToEdit->documents;
        $this->nameToEdit=$this->postToEdit->user->name;
        $UserID=$this->postToEdit->user_id;
        $this->doc_list=document_type::with(['documents'=>  function($q) use($UserID) {
            $q->where('user_id', '=', $UserID);
        }])->whereJsonContains('atributes->2', true)->get();
    }

    public function ViewDoc($postId){
        $this->docToView = documents::find($postId);
        $this->rvwStart=($this->docToView->state>0);
        $this->docToView->file=asset('storage/'.$this->docToView->file);
         
        $this->xOpen = true; 

    }

    public function sendComment()
    {
        $data=['document_id'=>$this->docToView->id,
        'user_id'=>auth()->user()->id,
        'text'=>$this->xComment,
        'read'=>false];
         comments::create($data);
        $this->reset('xComment');
    }

    public function updatedRvwStart($i)
    {
        $this->docToView->state=1;
        $this->docToView->save();

    }

    public function closeDetail()
    {
        $this->reset('postToEdit','doc_list','nameToEdit');
    }
}
