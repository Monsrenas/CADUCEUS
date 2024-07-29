 
   
 
<div class="py-12">
    @include('flashMesaje')
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white p-8"> 
        <div class="font-semibold text-xl text-gray-800 leading-tight mb-4">
            <h1>Reference Letter Upload Page</h1>
        </div>
        <div class="w-full  flow-root">
            <div class="w-full flex md:items-center mb-6">
                Please upload your reference letter concerning the applicant 
                <span class="font-bold ml-2 mr-2"> {{$this->document_to_edit->user->name;}}</span> 
                to this platform. The file in question must be in pdf format with a maximum size of 10 mb.            
            </div>
        </div>


         @include('forms.UploadLetter')
         
        <div class="flex w-screen  place-content-center p-0">
            <x-secondary-button wire:click="SaveRefLetter" wire:loading.attr="disabled" >
                Save
            </x-secondary-button>
        </div>
    </div>
</div>
