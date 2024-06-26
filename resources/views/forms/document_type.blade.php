<x-label value="Name" />
<x-input type="text" class="w-full" wire:model='field.1' />
<x-input-error for="field{{1}}" class="mt-2" />


<div class="inline flex mb-1 mt-2 items-center">
    <div>
    <x-label value="File format" />
    <select name="coder_type"  wire:model='field.2.1' 
                        class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-max py-2  text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-green-500">
                        <option value=""  selected hidden>Select</option>
                        <option value="0">PDF Document</option>
                        <option value="1">Image</option>
    </select>
    </div>
    <x-input type="checkbox" class="m-1 ml-4"  wire:model='field.2.4' />
    <x-label value="It expires" />
    @if ((isset($this->field[2][4]))and($this->field[2][4])
)    <div class="ml-4">
        <x-label value="Expiry time (in months)" />
        <x-input type="number" wire:model='field.2.5' class="w-min w-fit"/>
        <x-input-error for="field{{2,5}}"  />
    </div>
    @endif
</div>
<div class="inline flex p-4 m-4 mb-1 items-center">
    <x-input type="checkbox" class="m-1"  wire:model='field.2.2' />
    <x-label value="Applicant dashboard" />
    <x-input-error for="field{{2}}" class="mt-2" />
</div>
<div class="inline flex p-4 m-4 mt-1 items-center">
    <x-input type="checkbox"  class="m-1" wire:model='field.2.3' />
    <x-label value="Human resources dashboard" />
    <x-input-error for="field{{2}}" class="mt-2" />
</div>