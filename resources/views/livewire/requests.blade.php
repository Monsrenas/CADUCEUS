<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"> 
        <div class="w-full  flow-root">
            <div class="w-full flex md:items-center mb-6">
                <div class="w-full justify-end content-end">
                    <x-button wire:click="new" class="float-right bg-green-700 hover:bg-green-600">
                            New
                    </x-button>
                </div>
            </div>
              
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

</div>