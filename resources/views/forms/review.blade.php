<?php
  $staText=["Approved", "Rejected"];
?>

<x-dialog-modal wire:model="xOpen">
    <x-slot name='title'>
        <div class="mt-4">
            <div class="flex w-full  align-middle">
                <p class="uppercase  text-ml">  <span  class='text-blue-700  font-extrabold'>{{$nameToEdit}}</span></p>
                <div class="flex align-middle ml-20 ">
                    <input type="checkbox" class="mr-2"  wire:model='rvwStart' checked>
                    <p>Review started</p>
                </div>
            </div>
            @if (isset($this->docToView->doc_type))
                <p class="uppercase px-2 text-ml"> {{$this->docToView->doc_type->name}}  </p>
            @endif
        </div>
    </x-slot>
    <x-slot name='content'>
        @isset($this->DocFile)
            <iframe src="{{$this->DocFile}}" style="border: none; " id="miIframe" class="w-full min-h-80" >
            </iframe> 
        @endisset
    </x-slot>
    <x-slot name='footer'>
    <div class="grab  w-full" >    
        @if ($rvwStart)
        <div class="inline-flex w-full align-middle bg-blue-300 p-1 pl-4 mb-4">
            <p class="text-left text-sm font-extrabold mr-4">Status:</p>
                @foreach ($staText as $ind=>$itm)
                    <div class="w-full inline-flex">
                        
                        <input type="radio" id="stts{{$ind+1}}" value="{{$ind+2}}" 
                               name="statu" class="m-1" wire:model='field' class="text-sm " />
                         <label for="statu" class="text-sm ">{{$itm}}</label>
                    </div>
                @endforeach
        </div>   
        @endif
        <p class="text-left text-sm">Comments and/or notes for the applicant</p>
        <div class="inline-flex w-full ">
            <textarea name="comment" wire:model="xComment" class="w-full min-h-1 m-1"></textarea>
            <x-secondary-button wire:click="sendComment" wire:loading.attr="disabled" class="mt-2 mb-2 h-min">
                Send
            </x-secondary-button>
        </div>
        </div>   
    </x-slot>
</x-dialog-modal>  


