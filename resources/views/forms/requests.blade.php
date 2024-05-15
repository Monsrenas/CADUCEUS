<select name="coder_type"  wire:model='xcoder' 
    class="mb-4 bg-gray-200 appearance-none border-2 border-gray-200 rounded w-max py-2  text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-green-500">
    <option value=""  selected hidden>Select</option>
    <option value="0">Full time</option>
    <option value="1">Locum</option>
    <option value="2">Visiting</option>
</select>

<x-label value="Name" />
<x-input type="text" class="w-full" wire:model='name' />
<x-input-error for="field{{1}}" class="mt-2" />

<x-label value="Email" />
<x-input type="email" class="w-full" wire:model='email' />
<x-input-error for="field{{2}}" class="mt-2" />



