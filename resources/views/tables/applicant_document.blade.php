@php
    $staText=["awaiting review","Under review", "Approved", "Rejected"];
    
@endphp
<div class="relative h-fit shadow-md sm:rounded-lg">
  
    <div class="mb-4 bg-gray-600 full p-2">
    <p class="uppercase px-4 text-xl text-white">   Document list</p>
        <p class="uppercase px-4 text-xl">  <span  class='text-blue-400 text-lg font-extrabold '>{{$nameToEdit}}</span> </p>                
    </div>

    <table class="w-full text-sm text-left text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                
                <th>
                    Name
                </th>

                <th>
                    Status
                </th>
                <th class="text-center" >Actions</th>
            </tr>
        </thead>
        <tbody>
            
            @foreach ($doc_list as $item)
                <tr class="text-center border-b hover:bg-sky-200 hover:text-black">
                   
                    <td scope="col" 
                    @if (isset($item["documents"][0]))
                        class="px-2 py-3 text-left text-green-800"
                    @else    
                        class="px-2 py-3 text-left text-red-400"
                    @endif    
                        >
                        {{$item->name}}

                    </td>
                    
                    <td scope="col" class="px-2 py-3 text-left">
                       @if (isset($item["documents"][0]->state)) 
                        {{$staText[$item["documents"][0]->state]}}
                        @else
                        <span class="text-red-400">Not loaded</span> 
                       @endif 

                    </td>
                    <td class="px-6 text-center">
                        @if (isset($item["documents"][0]))
                            <a wire:click="ViewDoc({{ $item["documents"][0]->id }})"
                                class="w-full text-green-700 hover:text-white border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-xs px-5  text-center mr-2 ">
                                View
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
<div>
    <x-secondary-button wire:click="closeDetail" wire:loading.attr="disabled">
    Return to list
    </x-secondary-button>
</div>