<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

use App\Models\document_type;
use App\Models\documents;

class Applicant extends Component
{
    use WithFileUploads;

    public $open=false, $doc_list=[];
    public $DocName="", $modelFile, $document_to_edit, $file="", $type="", $expiry=0, $FileFormat=1, $attr=[];

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
        if ($this->document_to_edit)
        {
            $expiry=$this->document_to_edit->expiration;
            $DocFile=$this->document_to_edit->file;
        }

        $this->DocName=$this->type->name;
        $this->attr= json_decode($this->type->atributes,true);
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
    
        $exDate = Carbon::parse(now());

        $this->expiry=($this->expiry>0)?$this->expiry:120;
        $this->expiry = $exDate->addMonths($this->expiry);    

        $validatedData['file'] = $this->file->store('files', 'public');
        
        $data=['file'=> $validatedData['file'],
            'code_id'=> $this->type->id,
            'user_id'=>auth()->user()->id,
            'state'=>0,
            'expiration'=>$this->expiry,
        ];

        if ($this->document_to_edit)    
        {
            $regre=Storage::disk('public')->delete(public_path("/storage/".$this->document_to_edit->file));
            $this->document_to_edit->fill($data);
            $this->document_to_edit->save();
        }
        else {documents::create($data);}




        
    
        session()->flash('message', 'File successfully Uploaded.');
        $this->reset();
    }

    public function donwload()
    {
        return response()->download(public_path("/storage/".$this->modelFile->file));
    }
}
