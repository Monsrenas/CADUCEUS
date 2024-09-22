<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Requests') }}
        </h2>
    </x-slot>
<div class="py-12">
    @include('flashMesaje')
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"> 
        <div class="w-full  flow-root">
            <div class="w-full flex md:items-center mb-6">
                <div class="w-full justify-end content-end">
                    <x-button wire:click="new" class="float-right bg-green-700 hover:bg-green-600">
                            New
                    </x-button>
                </div>
            </div>
            @if ($lista)
                @include('tables.requests' )
            @endif
        </div>     
        
    </div>
    
    
        
<!-- Modal de Crear/editar -->
<x-dialog-modal wire:model="xOpen">
            <x-slot name='title'>
                <div class="inline-flex">
                    <p class="uppercase px-4 text-xl"> {{ $this->postToEdit ? 'Edit' : 'Create' }} Application</p>
                    
                </div>
            </x-slot>

            <x-slot name='content'>
                @include('forms.requests')
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