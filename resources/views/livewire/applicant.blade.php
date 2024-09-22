<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Applicant') }}
        </h2>
    </x-slot>
 <style>
    .card{
    background: blueviolet;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.654);
    padding: 16px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    gap: 20px;
    cursor: pointer;
    overflow: hidden;
    transition: all 0.75s ease-in-out;
    color: white;
}
.card:hover{
    background: white;
    box-shadow: 0 0 50px white;
}
</style>

<?php
    $documents= array("HPA application for Registration", "HPA application for Licensure/Renewal", "Curriculum vitae", "Police Record","Copy of passport");
    $colo=array( "red", "#63605f", "green");
    $status=["9203","128270","9989","x26d4"," x2714"];
?>
    <div class="py-12">
        @include('flashMesaje')
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg" >
                @include('tables.document')     
            </div>
        </div>
    
        <!-- Modal de Crear/editar -->
        <x-dialog-modal wire:model="open" >
                    <x-slot name='title'>
                        @if (!$this->editReference)
                        <div class="inline-flex">
                            <p class="text-md text-center">
                                
                                    {{$this->DocName}} 
                                
                            </p>
                        </div>
                        @endif
                    </x-slot>

                    <x-slot name='content'>
                        @if (($this->editReference)and($this->open))
                            @include('forms.references')  
                        @else
                            @if ($this->open)
                                @include('forms.document')
                            @endif 
                        @endif
                    </x-slot>

                    <x-slot name='footer'>
                        <div  class="float-left mr-20">
                            <x-danger-button wire:click="CloseEditReference()" wire:loading.attr="disabled">
                                Cancel  
                            </x-danger-button>
                        </div>

                        @if ($this->editReference)   
                           @if ($this->UpdatedInfo)
                                <x-secondary-button wire:click="Save_reference" wire:loading.attr="disabled">
                                    Save 
                                </x-secondary-button>
                            @endif
                        @else
                            @if (!$document_to_edit)
                            <x-secondary-button wire:click="save" wire:loading.attr="disabled"  wire:loading.remove>
                                Save
                            </x-secondary-button>
                            @endif
                        @endif
                    </x-slot>
        </x-dialog-modal>
    </div>
</div>