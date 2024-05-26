<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Response;

use App\Models\document_type;
use App\Models\documents;

class Applicant extends Component
{
    use WithFileUploads;

    private $preview=null;
    public $open=false, $doc_list=[];
    public $DocName="", $modelFile, $document_to_edit=null, $file="", $type="", $expiry=0, $FileFormat=1, $attr=[],
           $editReference=false, $field=[], $persons=0;

    public function render()
    {
        $this->docList();
        $doc_list=$this->doc_list;
        $prvw=$this->preview;
        if (auth()->user()->applicant->reference){
            $this->persons=count(json_decode(auth()->user()->applicant->reference->persons, true));
        }
        
        return view('livewire.applicant', compact('doc_list','prvw'));
    }

    public function DocDetail($id,$type)
    {
        $this->reset('document_to_edit', 'expiry','file','editReference');
        $this->type=document_type::find($type);

        $this->document_to_edit=documents::find($id);
        if ($this->document_to_edit)
        {
            $creado = $this->document_to_edit->created_at;
            $expiry = Carbon::parse($this->document_to_edit->expiration);
            $this->expiry=$creado->diffInMonths($expiry);

            $path =public_path("/storage/".$this->document_to_edit->file);
        }

        $this->DocName=$this->type->name;
        $this->attr= json_decode($this->type->atributes,true);
        $this->modelFile=$this->type->models;
        $this->open=true;
        
    }

    public function ReferenceDetail()
    {

        $Applicant= ('App\Models\\applicant')::where('user_id',auth()->user()->id)->first();
        if ($Applicant->reference)
        {
            $this->field=json_decode($Applicant->reference->persons,true);
       
        }

        $this->editReference=true;

        $this->open=true;
    }

    public function docList()
    {
        $userID=auth()->user()->id;
        
        $this->doc_list=document_type::with(['documents'=>  function($q) use($userID) {

            $q->where('user_id', '=', $userID);
    
        }])->whereJsonContains('atributes->2', true)->get();
    }

    public function save()
    {
        $validatedData = $this->validate([
            'file' => 'required',
            ]);
    
        $exDate = Carbon::parse(now());

        $this->expiry=($this->expiry>0)?$this->expiry:120;
        $this->expiry = $exDate->addMonths($this->expiry);    

        //$validatedData['file'] = $this->file->store('files', 'public');

        $validatedData['file'] = Storage::disk('public')->put('files', $validatedData['file']);

        $data=['file'=> $validatedData['file'],
            'code_id'=> $this->type->id,
            'user_id'=>auth()->user()->id,
            'state'=>0,
            'expiration'=>$this->expiry,
        ];
        
        if ($this->document_to_edit)    
        { 
            $this->DeleteFile($this->document_to_edit->file);
            $this->document_to_edit->fill($data);
            $this->document_to_edit->save();
        }
        else {documents::create($data);}
    
        session()->flash('message', 'File successfully Uploaded.');
        $this->reset();
    }

    public function Save_reference()
    {
        $Applicant= ('App\Models\\applicant')::where('user_id',auth()->user()->id)->first();
        $data=['applicant_id'=>$Applicant->id,
        'persons'=>json_encode($this->field)];

        if ($Applicant->reference)
        {
            $refPer=('App\Models\\reference')::find($Applicant->reference->id);
            $refPer->fill($data);
            $refPer->save();
        } else {
            ('App\Models\\reference')::create($data);
        }

        $this->reset();
    }

    public function donwload()
    {
        $charts=["<",">", ":", "“", "/", "\\", "|", "?", "*"];
        $name="Form_".$this->type->name;
        foreach ($charts as $key => $value) {
            $name=str_replace($value,"-",$name);
        }
        
        if (Storage::disk('public')->exists($this->modelFile->file)){
            return Storage::disk(name:'public')->download($this->modelFile->file,$name);
        }
    }

    public function DeleteDoc($DocToDel)
    {
        $this->DeleteFile($this->document_to_edit->file);
        $this->document_to_edit->delete();
        $this->reset();
    }

    public function DeleteFile($fileToDel)
    {
        if (Storage::disk('public')->exists($fileToDel)){
            $regre=Storage::disk(name:'public')->delete($fileToDel);
        }
    }
}
