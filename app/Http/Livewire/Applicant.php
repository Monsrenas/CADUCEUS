<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\document_type;
use App\Models\documents;

class Applicant extends Component
{

    public $doc_list=[];
    public $open=false, $DocName="", $modelFile, $document_to_edit;

    public function render()
    {
        $this->docList();
        $doc_list=$this->doc_list;
        return view('livewire.applicant', compact('doc_list'));
    }

    public function DocDetail($id,$type)
    {
        $type=document_type::find($type);
        $this->document_to_edit=documents::find($id);
        
        $this->DocName=$type->name;
        $this->modelFile=$type->models;

        $this->open=true;
    }

    public function docList()
    {
        $userID=auth()->user()->id;
        
        $this->doc_list=document_type::with(['documents'=>  function($q) use($userID) {

            $q->where('user_id', '=', $userID);
    
        }])->get();
    }
}
