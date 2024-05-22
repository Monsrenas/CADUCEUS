<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Carbon\Carbon;

use App\Models\document_type;
use App\Models\documents;

class Applicant extends Component
{
    use WithFileUploads;

    public $doc_list=[];
    public $open=false, $DocName="", $modelFile, $document_to_edit, $file="", $type="", $expiry ;

    public function render()
    {
        $this->docList();
        $doc_list=$this->doc_list;
        return view('livewire.applicant', compact('doc_list'));
    }

    public function DocDetail($id,$type)
    {
        $this->type=document_type::find($type);
        $this->document_to_edit=documents::find($id);
        
        $this->DocName=$this->type->name;
        $this->modelFile=$this->type->models;

        $this->open=true;
    }

    public function docList()
    {
        $userID=auth()->user()->id;
        
        $this->doc_list=document_type::with(['documents'=>  function($q) use($userID) {

            $q->where('user_id', '=', $userID);
    
        }])->get();
    }

    public function save()
    {
        $validatedData = $this->validate([
            'file' => 'required',
            ]);
    
        $validatedData['file'] = $this->file->store('files', 'public');
        
        $exDate = Carbon::parse(now());

        $this->expiry=($this->expiry>0)?$this->expiry:120;
        $this->expiry = $exDate->addMonths($this->expiry);

        $data=['file'=> $validatedData['file'],
        'code_id'=> $this->type->id,
        'user_id'=>auth()->user()->id,
        'state'=>0,
        'expiration'=>$this->expiry,
        ];



        documents::create($data);
    
        session()->flash('message', 'File successfully Uploaded.');
        $this->reset();
    }

    public function donwload()
    {
        return response()->download(public_path("/storage/".$this->modelFile->file));
    }
}
