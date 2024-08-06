<?php

namespace App\Http\Livewire;
use Illuminate\Http\Request;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class UploadReference extends Component
{
    use WithFileUploads;

    public $DocName="", $modelFile, $document_to_edit=null, $file="", $type="", $expiry=0, $FileFormat=1, $attr=[],
    $editReference=false, $field=[], $persons=0, $userLett="", $letterType="", $letterIndex="";

    public function mount(Request $request)
    {
       $LetterType=['Good Standing letter','Reference letter'];
       $this->document_to_edit= ('App\Models\\applicant')::with('reference')->where('user_id',$request->user)->first();

       if ($this->document_to_edit->reference)
       {
           $this->field=json_decode($this->document_to_edit->reference->persons,true);
       }

       $this->document_to_edit->state=0;
       $this->letterType=$LetterType[($request->refenceCode==0)?0:1];
       $this->letterIndex=$request->refenceCode;

    }

    public function render(Request $request)
    {
        $this->document_to_edit->state=0;
        return view('livewire.upload-reference');
    }


    public function SaveRefLetter() {
        $toValidate=[
            'file' => 'required|max:4990',
        ];

       //$atributes=json_decode($this->type->atributes,true);
        //if (isset($atributes[5])) $toValidate['expiry']=['required','date'];

        $validatedData = $this->validate($toValidate);

        $validatedData['file'] = Storage::disk('public')->put('files', $validatedData['file']);
        $this->field[1][$this->letterIndex][4]=$validatedData['file'];
    
        $this->document_to_edit->reference->persons=json_encode($this->field);
        $this->document_to_edit->reference->save();

        $this->dispatchBrowserEvent('message', [
            'body' => 'Your reference letter has been successfully registered in the CADUSEUS system.',
            'timeout' => 6000 ]);
    }
    
    public function DeleteDoc($DocToDel)
    {
       
        $this->DeleteFile($this->field[1][$this->letterIndex][4]);
        unset($this->field[1][$this->letterIndex][4]);
        $this->document_to_edit->reference->persons=$this->field;
        $this->document_to_edit->reference->save();

        $this->dispatchBrowserEvent('message', [
            'body' => 'Your reference letter has been DELETED from the CADUCEUS system!',
            'timeout' => 6000 ]);
    }

    public function DeleteFile($fileToDel)
    {
        if (Storage::disk('public')->exists($fileToDel)){
            $regre=Storage::disk(name:'public')->delete($fileToDel);
        }
    }
}