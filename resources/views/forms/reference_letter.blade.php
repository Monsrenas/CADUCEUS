<?php
  $staText=["With signs", "Approved", "Rejected"];
?>

<x-dialog-modal wire:model="yOpen">
    <x-slot name='title'>
        <div class="mt-4">
            <div class="flex w-full  align-middle">
                Reference Letter
            </div>
        </div>
    </x-slot>

    <x-slot name='content'>
        @if (isset($this->letterToView))
            <iframe src='{{$this->letterToView}}' id="miIframe" style="border: none;" class="w-full min-h-80"  >    
            </iframe>
        @endif
    </x-slot>
    
    <x-slot name='footer'>
       
    </x-slot>
</x-dialog-modal>  
