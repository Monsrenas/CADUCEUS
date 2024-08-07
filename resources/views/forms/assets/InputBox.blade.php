@php
     $cnt=($ini==1)?($cnt=(isset($field[1]))?count($field[1]):0) :  ((isset($field[1][0]))?1:0);
@endphp

@for ($i = $ini; $i<$cnt; $i++)
<tr>
    @if ($i<>0)
        <td rowspan="2" width="5%" class="text-center bg-gray-500 text-white  font-bold ">{{$i}}</td>
    @else
        <td rowspan="2"></td>    
    @endif
    <th class="text-center" width="10%">{{$name}}</th>

    <td class="text-center p-1 w-full" >
        <input type="text" class="w-full text-sm"  wire:model='field.1.{{$i}}.1'  
                @php echo (isset($this->field[1][$i][4])?'readonly':''); @endphp />
        <x-input-error for="field.1.{{$i}}.1" class="mt-2" />
    </td>
    @if ((isset($this->field[1][$i]))and(!isset($this->field[1][$i][4])))
        <td rowspan="2">
            <button wire:click="sendRequest({{$i}})" class="bg-gray-300 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">📨</button>
        </td>    
    @endif

    @if ((!isset($this->field[1][$i][4])))
       <td rowspan="2"><button wire:click="clearReference({{$i}})" class="bg-gray-300 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">🗑</button></td>
    @else
       <td rowspan="2" class="text-6xl text-green-600"> &#x2714</td>
    @endif   
</tr>
<tr>    
    <th>Email</th>
    <td class="text-center p-1">
        <input type="email" class="w-full text-sm" wire:model='field.1.{{$i}}.2' 
                @php echo (isset($this->field[1][$i][4])?'readonly':''); @endphp/>
        <x-input-error for="field.1.{{$i}}.2" class="mt-2" />
    </td>
</tr>
<tr> 
    <td class=""><hr></td>
    <td class=""><hr></td>
    <td class="w-full"><hr></td>
</tr>
<tr> 
    <td class=""><hr></td>
    <td class=""><hr></td>
    <td class="w-full"><hr></td>
</tr>
@endfor

@if (($ini>0)and(!isset($field[1][3]))or(($ini==0)and(!isset($field[1][0]))))
    <tr>
        <td class="w-full text-end py-2" colspan="5">
            <button wire:click='AddInput({{$ini}})' class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">add</button>
        </td>
    </tr>
@endif