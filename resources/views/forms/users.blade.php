
<?php 
    $access=["Requests", "Resources", "Review", "Users"];
    $Lvl=[[],["Chief of Medical Services","Chief of Clinical Service",
          "Chief of Allies Services"],
          ["Medical Services","Clinical Service",
          "Allies Services","Human Resources"]];
    $defaul=[[true,true,true,true],[true,true,false,false],[false,false,true,false]];
    if ($typeJob) $xAccess=$defaul[$typeJob];
?>

<x-label value="Type of user" />

<select   wire:model='typeJob' 
    class="mb-4 bg-gray-200 appearance-none border-2 border-gray-200 rounded w-max py-2  text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-green-500">
    <option value=""  selected hidden>Select</option>
    <option value="0">System administrator</option>
    <option value="1">SMT Lead</option>
    <option value="2">Committe member</option>
</select>
<x-input-error for="typeJob" class="mb-2" />

@if (($typeJob<>"0")and($typeJob<>"")) 
    <select   wire:model='xAccess.9' 
        class="mb-4 bg-gray-200 appearance-none border-2 border-gray-200 rounded w-max py-2  text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-green-500">
        <option value=""  selected hidden>Select group</option>
        @foreach ($Lvl[$typeJob] as $ind=>$itm)
            <option value="{{$ind}}">{{$itm}}</option>
        @endforeach
    </select>
    <x-input-error for="xAccess{{9}}" class="mb-2" />
@endif
<x-label value="Name" />
<x-input type="text" class="w-full" wire:model='name' />
<x-input-error for="name" class="mb-2" />

<x-label value="Email" />
<x-input type="email" class="w-full" wire:model='email' />
<x-input-error for="email" class="mt-b" />



@if ($typeJob<>"") 
    <p class="text-xl mt-4 font-bold">Access level</p>
    @foreach ($access as $ind=>$acc)
        <div class="inline-flex m-2">
        <x-input type="checkbox" class="m-1" wire:model='xAccess.{{$ind}}' />
        <x-label value="{{$acc}}" />
        </div>
    @endforeach
    <?php 
        if (!$this->xAccess) $this->xAccess=$defaul[$typeJob];
    ?>
@endif