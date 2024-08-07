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
            {{$this->letterToView}}
            <iframe src='{{$this->letterToView}}' id="miIframe" style="border: none;" class="w-full min-h-80"   wire:ignore >    
            </iframe>
        @endif
    </x-slot>
    
    <x-slot name='footer'>
        <div class="grab  w-full" >    
            <p class="text-left text-sm">Comments and/or notes for the referent. They will be sent to the registered email</p>
            <div class="inline-flex w-full ">
                <textarea name="comment" wire:model="xComment" class="w-full min-h-1 m-1"></textarea>
                <x-secondary-button wire:click="sendComment" wire:loading.attr="disabled" class="mt-2 mb-2 h-min">
                    Send
                </x-secondary-button>
            </div>
        </div>   
    </x-slot>
</x-dialog-modal>  
