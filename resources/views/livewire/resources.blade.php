<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"> 
        <div class="w-full  flow-root">
            <div class="w-full flex md:items-center mb-6">
                <x-label for="meCoder" class="px-4 text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-">Resource</x-label>
            
                <select name="coder_type"  wire:model='xcoder' 
                    class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-max py-2  text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-green-500">
                    <option value=""  selected hidden>Select</option>
                    <option value="document_type">Document Type</option>
                    <option value="models">Models</option>
                </select>
                
                @if ($xcoder)
                    <div class="w-full justify-end content-end">
                        <x-button wire:click="new" class="float-right bg-green-700 hover:bg-green-600">
                            New
                        </x-button>
                    </div>
                @endif
            </div>
            @if ($xcoder)
                @include('tables.'.$xcoder)
            @endif
        </div>
    </div>  
    
    
        <!-- Modal de Crear/editar -->
        <x-dialog-modal wire:model="open">
            <x-slot name='title'>
                <div class="inline-flex">
                    <p class="uppercase px-4 text-xl"> {{ $this->postToEdit ? 'Edit' : 'Create' }} {{ $this->xcoder }}</p>
                </div>
    
            </x-slot>
            <x-slot name='content'>
                
            @if ($xcoder)
                    @include('forms.'.$xcoder)
                @endif
            </x-slot>
            <x-slot name='footer'>
                    
                <x-secondary-button wire:click="{{$buttonSave}}" wire:loading.attr="disabled">
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
            Are you sure you want to <span class="text-red-700"> delete </span> this item?
            <p> <span class="uppercase">{{$this->xcoder}}: </span> <span  class='text-blue-700 text-lg font-extrabold'>{{$this->nameToDelete}}</span> </p>
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
