<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Review Dashboard') }}
        </h2>
    </x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"> 
        <div class="w-full  flow-root">
           @if ($postToEdit)
                @include('tables.applicant_document')
           @else
            @if ($lista)
                @include('tables.review' )
            @endif
           @endif 
        </div>     
      
    </div>
    @include('forms.review')
<!-- Modal de confirmacion de borrado -->
<x-confirmation-modal wire:model="showDeleteModal">
        <x-slot name='title'>
            <h5 class="modal-title">Deletion Confirmation</h5>
        </x-slot>
        <x-slot name='content'>

            Are you sure you want to <span class="text-red-700"> delete </span> the data of the Requester
            <p> <span  class='text-blue-700 text-lg font-extrabold'>{{$this->nameToDelete}}</span> ?</p>
        </x-slot>
        <x-slot name='footer'>
            <x-button wire:click="$set('showDeleteModal',false)" wire:loading.attr="disabled">
                Cancel
            </x-button>
            <x-danger-button wire:click="deletePost" wire:loading.attr="disabled" class="mx-14">
                Delete
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>
</div>