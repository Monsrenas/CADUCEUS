<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class UploadReference extends Component
{
    use WithFileUploads;

    public $DocName="", $modelFile, $document_to_edit=null, $file="", $type="", $expiry=0, $FileFormat=1, $attr=[],
    $editReference=false, $field=[], $persons=0;

    public function render()
    {
        return view('livewire.upload-reference');
    }
}
