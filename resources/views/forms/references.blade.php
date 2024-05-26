<table class="w-full">
    <thead>

        <th width="5%"></th>
        <th width="10%"></th>
        <th></th>
    </thead>  
    <tbody>
        @for ($i = 1; $i<=3; $i++)
            <tr>
                <td rowspan="2" width="5%" class="text-center bg-gray-500 text-white  font-bold ">{{$i}}</td>
                <th class="text-center" width="10%">Name</th>

                <td class="text-center p-1 w-full" >
                    <input type="text" class="w-full"  wire:model='field.1.{{$i}}.1'  />
                </td>
                <td rowspan="2"><button class="bg-gray-300 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">📨</button></td>
                <td rowspan="2"><button class="bg-gray-300 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">🗑</button></td>

            </tr>
            <tr>    
                <th>Email</th>
                <td class="text-center p-1">
                    <input type="email" class="w-full" wire:model='field.1.{{$i}}.2' />
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
