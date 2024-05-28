<?php
  $staText=["awaiting review","With signs", "Approved", "Rejected"];
  $FileAcc=[".pdf","image/*"];
  $atrb=(isset($attr[1]))?$attr[1]:0;
?>
 
<div class="w-full inline-block align-middle mb-4">
  
  @if (!$document_to_edit)
    <x-label value="File" />
      <x-input type="file"  wire:model='file' accept="{{$FileAcc[$atrb]}}"  />
    <x-input-error for="file" class="mt-2" />
  @endif

  @if (($modelFile)and(!$document_to_edit))
    <x-secondary-button wire:click="donwload" wire:loading.attr="disabled" class="float-right align-middle bg-green-700 hover:bg-green-600" >
    &#x1F4C1; Form   ⬇
    </x-secondary-button>
  @endif
</div>


  <x-label value="Expiry time (in months)" />
      <x-input type="number" wire:model='expiry' class="font-medium text-sm"/>
  <x-input-error for="expiry"  />

@if ($document_to_edit)
    <div class="w-full p-2 bg-gray-300 mt-2 text-black">
        
          <span class="font-semibold">Status:</span>  {{$staText[$document_to_edit->state]}}
          
    </div>
  <table class="w-full">
    <td>&#x1F4C1;</td>
    <td width="70%">My {{$document_to_edit->doc_type->name}}</td>
    <td class="text-center">
      @if (($document_to_edit->state==0))
        <a wire:click="DeleteDoc({{ $document_to_edit->id }})" 
          class="w-full text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-xs px-5  text-center mr-2 ">
            Delete 
        </a>
      @endif
    </td>
  </table>

  
  @if  (($document_to_edit->comments) and (count($document_to_edit->comments)>0))
    <p class="text-xl mt-4">Review Comments</p>
    @foreach ($document_to_edit->comments->sortByDesc('created_at') as $cmts)
        <div>
         <p class="font-extrabold"> 
           <span class="text-blue-400"> {{date('d-m-Y h:i:s',strtotime($cmts->created_at))}}</span>> 
           {{$cmts->text}}

         </p>
        </div>
    @endforeach   
    > 
  @endif
@endif