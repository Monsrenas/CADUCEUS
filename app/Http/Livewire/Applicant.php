<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\document_type;

class Applicant extends Component
{

    public $doc_list=[];
    public $open=false, $DocName="";

    public function mount()
    {
        $this->doc_list=document_type::get();
    }

    public function render()
    {
        $doc_list=$this->doc_list;
        return view('livewire.applicant', compact('doc_list'));
    }

    public function DocDetail($name)
    {
        $this->DocName=$name;
        $this->open=true;
    }
}
