 <table class="w-full">
    <thead>
        <th width="5%"></th>
        <th width="10%"></th>
        <th></th>
    </thead>  
    <tbody>
        <tr>
            <th colspan="5">Medical/nursing council/health partners</th> 
        </tr>
        <tr>
            <th></th>
            <th  class="text-center" >Representative</th>
            <td class="text-center p-1 w-full" >
                <input type="text" class="w-full text-sm"  wire:model='field.1.0.1' 
                       @php echo (isset($this->field[1][0][4])?'readonly':''); @endphp />
                <x-input-error for="field.1.0.1" class="mt-2" />
            </td>
            @if ((isset($this->field[1][0][3]))and($this->field[1][0][3])and(!isset($this->field[1][0][4])))
                <td rowspan="2"><button wire:click="sendRequest(0)" class="bg-gray-300 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">📨</button></td>    
            @endif
            @if ((!isset($this->field[1][0][4])))
                <td rowspan="2"><button wire:click="clearReference(0)" class="bg-gray-300 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">🗑</button></td>
            @else
                <td rowspan="2" class="text-6xl text-green-600"> &#x2714</td>
            @endif
        </tr>
        <tr  >    
            <th></th>
            <th class="mb-2">Email</th>
            <td class="text-center p-1">
                <input type="email" class="w-full text-sm" wire:model='field.1.0.2' 
                       @php echo (isset($this->field[1][0][4])?'readonly':''); @endphp />
                <x-input-error for="field.1.0.2" class="mt-2" />
            </td>
        </tr>
        <tr>  <td colspan="5"> </td>  </tr>
        <tr>  <td colspan="5"> <hr> </td>  </tr>
        <tr>  <td colspan="5"> . </td>  </tr>
        <tr>
            <th colspan="5">List 3 people</th> 
        </tr>
        @for ($i = 1; $i<=3; $i++)
            <tr>
                <td rowspan="2" width="5%" class="text-center bg-gray-500 text-white  font-bold ">{{$i}}</td>
                <th class="text-center" width="10%">Name</th>

                <td class="text-center p-1 w-full" >
                    <input type="text" class="w-full text-sm"  wire:model='field.1.{{$i}}.1'  
                            @php echo (isset($this->field[1][$i][4])?'readonly':''); @endphp />
                    <x-input-error for="field.1.{{$i}}.1" class="mt-2" />
                </td>
                @if ((isset($this->field[1][$i][3]))and($this->field[1][$i][3])and(!isset($this->field[1][$i][4])))
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
    </tbody>
</table>