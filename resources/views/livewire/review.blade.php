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
    
    
        
<!-- Modal de Crear/editar -->
<x-dialog-modal wire:model="xOpen">
            <x-slot name='title'>
                <div class="mt-4">
                    <p class="uppercase px-4 text-xl">  <span  class='text-blue-700  font-extrabold'>{{$nameToEdit}}</span></p>
                    Review started
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
                
            <div class="inline-flex w-full">
                <textarea name="comment" id="" class="w-full min-h-1 m-1"></textarea>
                <x-secondary-button wire:click="sendCommend" wire:loading.attr="disabled" class="mt-2 mb-2 h-min">
                    Comment
                </x-secondary-button>
            </div>
                
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