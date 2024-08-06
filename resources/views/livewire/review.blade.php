<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Review Dashboard') }}
        </h2>
    </x-slot>
<div >
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
       
        <div class="w-full  flow-root">
            @if ($postToEdit)
                <div style=" display: grid; grid-template-columns: 2fr 1fr;  grid-column-gap: 10px;
                                                                   grid-row-gap: 1em; padding: 14px;"> 
                    @include('tables.applicant_document')
                    <div>
                        @include('forms.reference_letter')
                         @include('tables.reference_letters')
                    </div>
                </div>
                <div style="position: fixed; bottom: 5%; left: 44%; "    >
                    <x-secondary-button   wire:click="closeDetail" wire:loading.attr="disabled" 
                    style="-webkit-box-shadow: 2px 10px 17px 0px rgba(0,0,0,0.75);
                           -moz-box-shadow: 2px 10px 17px 0px rgba(0,0,0,0.75); box-shadow: 2px 10px 17px 0px rgba(0,0,0,0.75);">
                        Return to applicant list
                    </x-secondary-button>
                </div>
            @else
              <div class="py-12"> 
                    @if ($lista)
                        @include('tables.review' )
                    @endif
                </div>
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