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
    $colo=array("gray","orange", "green", "red");
    $status=["8986","x2699","9745","x26d4"," x2714"];
?>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg" >
                @include('tables.document')     
            </div>
        </div>
    
        <!-- Modal de Crear/editar -->
        <x-dialog-modal wire:model="open">
                    <x-slot name='title'>
                        <div class="inline-flex">
                            <p class="uppercase  text-xl text-center">
                                @if ($this->editReference)
                                Institutions and people to whom a reference letter request will be sent.
                                @else
                                    {{$this->DocName}} 
                                @endif
                            </p>
                        </div>
                    </x-slot>

                    <x-slot name='content'>
                        @if ($this->editReference)
                            @include('forms.references')  
                        @else
                            @include('forms.document')
                        @endif
                    </x-slot>

                    <x-slot name='footer'>
                        @if ($this->editReference)    
                            <x-secondary-button wire:click="Save_reference" wire:loading.attr="disabled">
                                Save 
                                @if (!$this->MailSendYet())
                                and Send    
                                @endif 
                                
                            </x-secondary-button>
                        @else
                            @if (!$document_to_edit)
                            <x-secondary-button wire:click="save" wire:loading.attr="disabled">
                                Save
                            </x-secondary-button>
                            @endif
                        @endif
                    </x-slot>
        </x-dialog-modal>
    </div>
</div>