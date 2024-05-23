
<div class="relative h-fit shadow-md sm:rounded-lg">
    
    <table class="w-full text-sm text-left text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                
                <th scope="col" class="px-2 py-3 text-center">
                    No.
                </th>
                <th>
                    Name
                </th>

                <th class="text-center" >Actions</th>
            </tr>
        </thead>
        <tbody>
            
            @foreach ($lista as $item)
                <tr class="text-center border-b hover:bg-sky-200 hover:text-black">
                    <td class="w-4 text-gray-400">
                        
                    </td> 
                    <td scope="col" class="px-2 py-3 text-left">
                        {{$item["name"]}}
                    </td>
                    
                    <td class="px-6 text-center">
                        <a wire:click="edit({{ $item->id }})"
                            class="w-full text-green-700 hover:text-white border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-xs px-5  text-center mr-2 ">
                            Edit
                        </a>
                        @if ((!isset($item->models)))
                        <a wire:click="confirmDelete({{ $item->id }})" 
                            class="w-full text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-xs px-5  text-center mr-2 ">
                            Delete 
                        </a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-1">
         
        {{ $lista->links() }}
    
    </div>    
</div>
