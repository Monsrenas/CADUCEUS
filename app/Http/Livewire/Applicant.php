<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\document_type;
use App\Models\documents;

class Applicant extends Component
{

    public $doc_list=[];
    public $open=false, $DocName="";

    public function mount()
    {
        $userID=auth()->user()->id;
        
        $this->doc_list=document_type::with(['documents'=>  function($q) use($userID) {

            $q->where('user_id', '=', $userID);
    
        }])->get();
       
    }

    public function render()
    {
        $doc_list=$this->doc_list;
        return view('livewire.applicant', compact('doc_list'));
    }

    public function DocDetail($id,$type)
    {
        $docType=documents::find($id);
        $this->DocName=$id;
        $this->open=true;
    }
}
