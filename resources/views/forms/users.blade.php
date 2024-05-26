
<x-label value="Type of user" />

<select   wire:model='typeJob' 
    class="mb-4 bg-gray-200 appearance-none border-2 border-gray-200 rounded w-max py-2  text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-green-500">
    <option value=""  selected hidden>Select</option>
    <option value="0">Administrator</option>
    <option value="1">Leader SMT</option>
    <option value="2">Committe member</option>
</select>
<x-input-error for="typeJob" class="mb-2" />

<x-label value="Name" />
<x-input type="text" class="w-full" wire:model='name' />
<x-input-error for="name" class="mb-2" />

<x-label value="Email" />
<x-input type="email" class="w-full" wire:model='email' />
<x-input-error for="email" class="mt-b" />



