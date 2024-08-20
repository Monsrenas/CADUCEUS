<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use Response;

use App\Models\document_type;
use App\Models\documents;

class Applicant extends Component
{
    use WithFileUploads;

    private $preview=null;
    public $open=false, $doc_list=[];
    public $DocName="", $modelFile, $document_to_edit=null, $file="", $type="", $expiry=0, $FileFormat=1, $attr=[],
           $editReference=false, $field=[], $persons=0, $UpdatedInfo=false, $saved=true,
           $grupTitle=['The Council of Medicine and Dentistry','The Council of Nursing and Midwifery','The Council of Allied Health'];

    public function render()
    {
        $this->docList();
        $doc_list=$this->doc_list;
        $prvw=$this->preview;
        if (auth()->user()->applicant->reference){ // cantidad de personas de referencia registradas
            $references=json_decode(auth()->user()->applicant->reference->persons, true);
            $this->persons=(isset($references[1]))?count($references[1]):0;
        }
        
        return view('livewire.applicant', compact('doc_list','prvw'));
    }

    public function updatedField()
    {
           $this->UpdatedInfo=true; 
           $this->saved=false;
    }

    public function getTemporalLink($refenceCode)
    {
        return URL::temporarySignedRoute(
            'UploadReference', 
            now()->addDays(15), 
            ['refenceCode' =>$refenceCode, 'user' => auth()->user()]
        );
    }

    public function DocDetail($id,$type)
    {
        $this->reset('document_to_edit', 'expiry','file','editReference');
        $this->type=document_type::find($type);

        $this->document_to_edit=documents::find($id);
        if ($this->document_to_edit)
        {
            //$creado = $this->document_to_edit->created_at;
            //$expiry = Carbon::parse($this->document_to_edit->expiration);
            //$this->expiry=$creado->diffInMonths($expiry);
            $this->expiry=$this->document_to_edit->expiration;
            if (Storage::disk('public')->exists($this->document_to_edit->file)){
            $path =public_path("/storage/".$this->document_to_edit->file);} else { $this->document_to_edit->delete();}

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

    public function CloseEditReference()  {$this->reset();}  

    public function docList()
    {
        $userID=auth()->user()->id;
        
        $this->doc_list=document_type::with(['documents'=>  function($q) use($userID) {

            $q->where('user_id', '=', $userID);
    
        }])->whereJsonContains('atributes->2', true)->get();
    }

    public function save()
    {
        //$exDate = Carbon::parse(now());
        //$this->expiry=($this->expiry>0)?$this->expiry:120;
        //$this->expiry = $exDate->addMonths($this->expiry); 

        $toValidate=[
            'file' => 'required|max:4990',

        ];

        $atributes=json_decode($this->type->atributes,true);
        if (isset($atributes[5])) $toValidate['expiry']=['required','date'];

        $validatedData = $this->validate($toValidate);
          
        if ($this->expiry){ 
            $exDate = Carbon::parse($this->expiry);
            $this->expiry = $exDate->addMonths($atributes[5]);
        } else {
            $exDate = Carbon::parse(now());
            $this->expiry = $exDate->addMonths(120);
        }

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
        $this->saved=true;
    }

    public function Save_reference()
    {
        $vldt=$this->validate(['field.1.*.*'=> 'required',
                              'field.1.*.2'=> 'required|email']);
        //dd($this->field);
        //for ($i=0; $i < 4; $i++) {
            
          //      if ((isset($this->field[1][$i]))and(!isset($this->field[1][$i][3]))) {$this->SendMail($i, $this->field[1][$i]);}  
          //      $this->field[1][$i][3]=true; 
            
       // }

        $Applicant= ('App\Models\\applicant')::where('user_id',auth()->user()->id)->first();
        $data=['applicant_id'=>$Applicant->id,  'persons'=>json_encode($this->field)];

        if ($Applicant->reference)
        {
            $refPer=('App\Models\\reference')::find($Applicant->reference->id);
            $refPer->fill($data);
            $refPer->save();
        } else {
            ('App\Models\\reference')::create($data);
        }
        $TextMessage=$this->MailSendYet()?'Your updates have been saved successfully!':'Your request for a reference letter has been sent to the registered persons, successfully!';
        $this->dispatchBrowserEvent('message', [
            'body' => $TextMessage,
            'timeout' => 6000 ]);

        $this->reset();
    }

    public function readed($id)
    {    
        $cmm=('App\Models\\comments')::find($id);
        $cmm->fill(['read'=>true]);
        $cmm->save();
        $this->docList();
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

    public function clearReference($ind)
    {
        unset($this->field[1][$ind]);
        $this->UpdatedInfo=true;   //Activating the save button
        //dd($this->field);
        //Re-index the list of referrers
        if ($ind<>0){
                for ($i=1; $i <4 ; $i++) { 
                    if (!isset($this->field[1][$i])) {
                        if (isset($this->field[1][$i+1])) {
                            $this->field[1][$i]=$this->field[1][$i+1];
                            unset($this->field[1][$i+1]);
                        }
                    }
                }
        }
    }

    public function AddInput($pst)
    {
        $ind=$pst;
        if ($pst<>0){
            $ind=(isset($this->field[1]))?count($this->field[1])+1:$pst;
       } 

     
        $this->field[1][$ind][1]="";
        $this->field[1][$ind][2]="";
        $this->field[1][$ind][3]=false;
        $this->saved=false; 
    }

    public function MailSendYet()
    {
        $contSY=0;

        if (isset($this->field[1])){
            $SendYet = array_column($this->field[1], '3');
            foreach ($SendYet as $key => $value) {
                $contSY=$contSY+($value ? 1 : 0);
            }
        }
        return $contSY; //($contSY==4 ? true : false);;
    }

    public function sendRequest($ind)
    {
        $this->field[1][$ind][3]=true;
        $this->SendMail($ind, $this->field[1][$ind]);

        
        $this->dispatchBrowserEvent('message', [
            'body' => 'Your request for a reference letter has been successfully forwarded to '.$this->field[1][$ind][1].' !',
            'timeout' => 6000 ]);
            $this->reset();
    }

    public function SendMail($tIn, $info)
    {        
        $grupInx=json_decode( auth()->user()->access,true);

        $tmpLink=$this->getTemporalLink($tIn);
        if ($tIn>0) {$tIn=1;}

        $type=[['Good Standing letter Request','Good Standing letter Request'],
               ['Reference letter Request','Reference letter Request']];
              
        Mail::send('emails.letter-request-mail',
        array(
                'name' => $info[1],
                'email' => $info[2],
                'userName'=>auth()->user()->name,
                'tmpLink'=>$tmpLink,
                'reference'=>$tIn,
                'Title'=>$type[$tIn][1],
                'Group'=>$this->grupTitle[$grupInx[9]],
            ),
            function($message) use ($type, $tIn, $info){ 
                $message->from('references@tcihospital.tc','InterHealthCanada');
                $message->to($info[2],$info[1] )->subject($type[$tIn][0]);
            }
        );
    }
}
