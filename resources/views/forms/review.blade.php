<?php
  $staText=["With signs", "Approved", "Rejected"];
?>

<x-dialog-modal wire:model="xOpen">
    <x-slot name='title'>
        <div class="mt-4">
            <div class="inline-flex w-full  ">
                <p class="uppercase px-4 text-xl">  <span  class='text-blue-700  font-extrabold'>{{$nameToEdit}}</span></p>
                <div class="float-right inline-flex ">
                    <input type="checkbox" class="m-2">
                    <p>Review started</p>
                </div>
            </div>
            @if (isset($this->docToView->doc_type))
                <p class="uppercase px-4 text-xl"> {{$this->docToView->doc_type->name}}  </p>
            @endif
        </div>
    </x-slot>
    <x-slot name='content'>
        @if (isset($docToView->file))
             
        <iframe src="{{$docToView->file}}" style="border: none; " class="w-full min-h-96">
        </iframe>
        @endif
    </x-slot>
    <x-slot name='footer'>
    <div class="grab  w-full" >    
        <div class="inline-flex w-full">
            @foreach ($staText as $itm)
                <div class="m-2 w-full inline-flex">
                    
                    <x-input type="radio" class="m-1" wire:model='file' />
                    <x-label value="{{$itm}}" />
                </div>
            @endforeach
        </div>   
        <br>
        <div class="inline-flex w-full">
            <textarea name="comment" id="" class="w-full min-h-1 m-1"></textarea>
            <x-secondary-button wire:click="sendCommend" wire:loading.attr="disabled" class="mt-2 mb-2 h-min">
                Comment
            </x-secondary-button>
        </div>
        </div>   
    </x-slot>
</x-dialog-modal>  
