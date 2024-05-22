<?php
  $staText=["awaiting review","With signs", "Approved", "Rejected"];
?>

<div class="w-full inline-block align-middle mb-4">
   
  <x-label value="File" />
    <x-input type="file"  wire:model='file' accept="image/*" />
  <x-input-error for="file" class="mt-2" />

  @if (($modelFile)and(!$document_to_edit))
    <x-secondary-button wire:click="donwload" wire:loading.attr="disabled" class="float-right align-middle bg-green-700 hover:bg-green-600" >
    &#x1F4C1; Form   ⬇
    </x-secondary-button>
  @endif
</div>

<x-label value="Expiry time" />
    <x-input type="number" wire:model='expiry'/>
<x-input-error for="expiry"  />

@if ($document_to_edit)
  <div class="w-full p-2 bg-gray-300 mt-2 text-black">
      
        <span class="font-semibold">Status:</span>  {{$staText[$document_to_edit->state]}}
      
  </div>
@endif