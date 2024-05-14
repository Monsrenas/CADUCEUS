<form wire:submit.prevent="submit" enctype="multipart/form-data">

    <x-label for="meCoder" >Document Type</x-label>
                
    <select name="coder_type"  wire:model='code_id' 
        class="mb-4 bg-gray-200 appearance-none border-2 border-gray-200 rounded w-max py-2  text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-green-500">
        <option value="A"  selected hidden>Select</option>
        @foreach  ($docType as $ndc=>$colu)
            <option value="{{$colu->id}}">{{$colu->name}}</option>
        @endforeach
    </select>

    <x-label value="Model file" />
    <x-input type="file" class="w-full" wire:model='file' />
    <x-input-error for="field{{1}}" class="mt-2" />
    <button type="submit" class="btn btn-success">Save</button>

</form>
