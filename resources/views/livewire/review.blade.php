<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Review Dashboard') }}
        </h2>
    </x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"> 
        <div class="w-full  flow-root">
           
            @if ($lista)
                @include('tables.review' )
            @endif
        </div>     
        
    </div>
    
    
        
<!-- Modal de Crear/editar -->
<x-dialog-modal wire:model="xOpen">
            <x-slot name='title'>
                <div class="inline-flex">
                    <p class="uppercase px-4 text-xl">  <span  class='text-blue-700 text-lg font-extrabold'>{{$nameToEdit}}</span> Document list</p>
                    
                </div>
            </x-slot>

            <x-slot name='content'>
                @include('tables.applicant_document')
            </x-slot>

            <x-slot name='footer'>
                    
                <x-secondary-button wire:click="save" wire:loading.attr="disabled">
                    Save
                </x-secondary-button>
                
            </x-slot>
</x-dialog-modal>  

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