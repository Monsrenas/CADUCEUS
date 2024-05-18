<x-label value="Name" />
<x-input type="text" class="w-full" wire:model='field.1' />
<x-input-error for="field{{1}}" class="mt-2" />
<div class="inline flex p-4 m-4 mb-1 items-center">
    <x-input type="checkbox" class="m-1"  wire:model='field.2.1' />
    <x-label value="Applicant dashboard" />
    <x-input-error for="field{{2}}" class="mt-2" />
</div>
<div class="inline flex p-4 m-4 mt-1 items-center">
    <x-input type="checkbox"  class="m-1" wire:model='field.2.2' />
    <x-label value="Human resources dashboard" />
    <x-input-error for="field{{2}}" class="mt-2" />
</div>