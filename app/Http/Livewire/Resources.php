<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class Resources extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $field=[], $columna=[],$open=false, $xcoder="", $postToEdit="", $nameToDelete="", $list=[], $modelo="",
           $docType=[], $code_id="", $buttonSave="sabe";
    public $file, $title;

    public function mount()
    {
        $this->docType=('App\Models\\document_type')::all();
    }

    public function render()
    {
        $lista=[];
        
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
    }

    public function new(){
        $this->reset('postToEdit','field');
        $this->open = true;
    }

    public function save() {
        
        $vldt=$this->validate(['field.*'=> 'required']);
       
        if (isset($vldt['field'])){
                for ($i = 1; $i <= count($this->field); $i++) {
                    $datos[$this->columna[$i-1]]=$this->field[$i]; 
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
        $this->open = true; 

    }

    

    public function submit()

    {

        $validatedData = $this->validate([
        'file' => 'required',
        'code_id' => 'required',
        

        ]);

        $validatedData['file'] = $this->file->store('files', 'public');
    
        ('App\Models\\models')::create($validatedData);

        session()->flash('message', 'File successfully Uploaded.');

    }

}
