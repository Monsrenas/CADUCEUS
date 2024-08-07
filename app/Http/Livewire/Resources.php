<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Resources extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $field=[], $columna=[],$open=false, $xcoder="", $postToEdit="", $list=[], $modelo="",
           $docType=[], $code_id="", $buttonSave="sabe",
           $showDeleteModal, $postIdToDelete="", $nameToDelete="";
    public $file, $title;

    public function mount()
    {
        $this->docType=('App\Models\\document_type')::all();
    }

    public function render()
    {
        $lista=[];
        $this->docType=('App\Models\\document_type')::all();
        if ($this->modelo) {
            
            $lista=($this->modelo)::paginate(6);
        }
        return view('livewire.resources', compact('lista'));
    }

    public function updatedXcoder(){
        $this->modelo="App\Models\\".$this->xcoder;

        if ($this->xcoder) {
            $modelo = new ($this->modelo);    
            $this->columna=$modelo->getFillable();
        }
        $this->buttonSave=($this->xcoder=="document_type")? "save":"submit";
        $this->resetPage();
    }

    public function new(){
        $this->DTypeEmpty();
        $this->reset('postToEdit','field');
        $this->open = true;
    }

    public function DTypeEmpty()
    {
        $firstElement=$this->docType=('App\Models\\document_type')::first();
        
    }

    public function save() {
        
        $vldt=$this->validate(['field.*'=> 'required']);
        if (isset($vldt['field'])){
                for ($i = 1; $i <= count($this->field); $i++) {
                    if (gettype($this->field[$i])=="array") {$this->field[$i]=json_encode($this->field[$i]);}
                    if ((isset($this->columna[$i-1])) and (isset($this->field[$i]))) 
                    {$datos[$this->columna[$i-1]]=$this->field[$i]; }
                }
                if ($this->postToEdit=="") {
                    $this->postToEdit=($this->modelo)::create($datos);
                }
                    else
                    {
                        $this->postToEdit->fill($datos);
                        $this->postToEdit->save();

                    }
            $this->open = false;
            $this->reset('postToEdit','field');
        }
    }

    public function edit($postId){
        $this->postToEdit = ($this->modelo)::find($postId);
        $this->field=array();

        if ($this->postToEdit) {
            for ($i = 0; $i <= count($this->columna)-1; $i++) {
               $this->field[$i+1]=$this->postToEdit[$this->columna[$i]];
            }
        }
        
        if ($this->xcoder=="document_type") {$this->field[2]=json_decode($this->field[2],true);}
        else { $this->code_id=$this->postToEdit->code_id; }
        $this->open = true; 

    }

    public function submit()

    {

        $validatedData = $this->validate([
        'file' => 'required |max:4990',
        'code_id' => 'required',
        

        ]);

        $validatedData['file'] = $this->file->store('files', 'public');
    
         

        if ($this->postToEdit)    
        { 
            $this->DeleteFile($this->postToEdit->file);
            $this->postToEdit->fill($validatedData);
            $this->postToEdit->save();
        }
        else {('App\Models\\models')::create($validatedData);}


        session()->flash('message', 'File successfully Uploaded.');
        $this->reset('postToEdit','open','field');
    }

    public function confirmDelete($postId){
        
        $this->postIdToDelete = $postId;
        $PtoDel= ('App\Models\\'.$this->xcoder)::find($postId);
        $this->nameToDelete=($this->xcoder=='models')?$PtoDel->doc_type->name:$PtoDel->name;
        $this->showDeleteModal = true;
    }

    public function deletePost(){
        if ($this->postIdToDelete) {
            $post = ('App\Models\\'.$this->xcoder)::find($this->postIdToDelete);
            if ($post) {
                if ($this->xcoder=='models') { $this->DeleteFile($post->file);   }
                $post->delete();
            }
        }

        $this->reset('postIdToDelete','nameToDelete');
        $this->showDeleteModal = false;
    }

    public function DeleteFile($fileToDel)
    {
        if (Storage::disk('public')->exists($fileToDel)){
                
            $regre=Storage::disk(name:'public')->delete($fileToDel);
        }
    }
}
