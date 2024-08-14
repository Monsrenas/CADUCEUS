<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\applicant;
use App\Models\document_type;
use App\Models\documents;
use App\Models\comments;
use App\Models\reference;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Mail;

class Review extends Component
{

    public $postToEdit="", $xOpen=false, $appInRev="";
    public $typeJob="",$name, $email="", $tmpPassword="";
    public $doc_list=[], $nameToEdit="",$nameToDelete="", $showDeleteModal=false,
           $docToView=[], $field="", $rvwStart=false, $xComment="",$xGroup="", $xName="", $DocFile=""
           ,$reference_letter=[], $LetterType=['Good Standing letter','Reference letter'], $letterToView="", $reference_info=null,$yOpen=false;

    public function render()
    {
        $xGroup=$this->xGroup;   
        $xName=$this->xName;
        $lista=User::whereHas('applicant')->when($this->xGroup<>'', function ($query) use ($xGroup) {
            $query->whereJsonContains('access->9', $xGroup);
        })->when(($this->xName<>""), function($q) use ($xName){
            return $q->where('name', 'like','%'.$xName.'%');
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
        $this->appInRev=$this->postToEdit->user_id;
        $UserID=$this->appInRev;
        $this->doc_list=document_type::with(['documents'=>  function($q) use($UserID) {
            $q->where('user_id', '=', $UserID);
        }])->whereJsonContains('atributes->2', true)->get();

        $this->reference_info= ('App\Models\\applicant')::with('reference')->where('user_id',$UserID)->first(); 
        if ($this->reference_info->reference)  {
            $this->reference_letter=json_decode($this->reference_info->reference->persons,true);
            $this->reference_letter= $this->reference_letter[1];
        }
    }

    public function ViewDoc($post){
          
        $this->docToView = documents::find($post);
       
        if ($this->docToView) {
            $this->rvwStart=($this->docToView->state>0);
            $this->docToView->file=asset('storage/'.$this->docToView->file);
            $this->DocFile=$this->docToView->file;
            $this->xOpen = true; 
        }
        $this->Applicant_details($this->postToEdit->id);
    }

    public function ViewLetter($ind){
        $this->letterToView=$this->reference_letter[$ind][4];
         
        if (Storage::disk('public')->exists($this->letterToView)){
            $this->letterToView=asset('storage/'.$this->letterToView);
            $this->DocFile=$this->letterToView;
            $this->yOpen = true;
        } else  {   
                    unset($this->reference_letter[$ind][4]);
                    $this->reference_info->reference->persons=json_encode(["1"=>$this->reference_letter]);
                    $this->reference_info->reference->save();
                }
        $this->Applicant_details($this->postToEdit->id);
    }

    public function sendComment()
    {
        $data=['document_id'=>$this->docToView->id,
        'user_id'=>auth()->user()->id,
        'text'=>$this->xComment,
        'read'=>false];
         comments::create($data);
        $this->reset('xComment');
        
        $this->Applicant_details($this->postToEdit->id);
    }

    public function updatedRvwStart($i)
    {
        $this->docToView->state=($this->docToView->state==1)?0:1;
        $this->docToView->save();
        $this->Applicant_details($this->postToEdit->id);
    }

    public function updatedField()
    {
        $this->docToView->state=$this->field;
        $this->docToView->save();
        $this->Applicant_details($this->postToEdit->id);
    }


    public function closeDetail()
    {
        $this->reset('postToEdit','doc_list','nameToEdit');
    }
}
