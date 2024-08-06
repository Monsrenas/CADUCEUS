@php
    $staText=["awaiting review","Under review", "Approved", "Rejected"];
    
@endphp
<div class="relative h-fit shadow-md sm:rounded-lg">
  
    <div class="mb-4 bg-gray-600 full p-2">
    <p class="uppercase px-4 text-xl text-white">   Document list:  <span  class='text-blue-400 text-lg font-extrabold '>{{$nameToEdit}}</span> </p>               
    </div>

    <table class="w-full text-sm text-left text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th class="px-2">
                    Name
                </th>

                <th class="px-2" >
                    Status
                </th>
            </tr>
        </thead>
        <tbody>
            
            @foreach ($doc_list as $item)

                <tr class="text-center border-b hover:bg-sky-200 hover:text-black"    
                        @if (isset($item["documents"][0]))
                            wire:click="ViewDoc({{ $item["documents"][0]->id }})"
                        @endif >
                   
                    <td scope="col" 
                    @if (isset($item["documents"][0]))
                        class="px-2 py-1 text-left text-green-800"
                    @else    
                        class="px-2 py-1 text-left text-red-400"
                    @endif    
                        >
                        {{$item->name}}

                    </td>
                    
                    <td scope="col" class="px-2 py-1 text-left">
                       @if (isset($item["documents"][0]->state)) 
                        {{$staText[$item["documents"][0]->state]}}
                        @else
                        <span class="text-red-400">Not loaded</span> 
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