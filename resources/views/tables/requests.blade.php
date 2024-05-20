@php
    $status=["Started","Under review","Approved","Rejected"];
    $TOJ=["Full time","Locum","Visiting"];
@endphp
<div class="relative h-fit shadow-md sm:rounded-lg">
    
    <table class="w-full text-sm text-left text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th class="px-2 py-3 text-center">
                    Applicant name
                </th>
                <th>
                    Type
                </th>
                <th class="text-center" >Email</th>
                <th class="px-2 py-3 text-center">Application Status</th>
                <th class="px-2 py-3 text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            
            @foreach ($lista as $item)
                <tr class="text-center border-b hover:bg-sky-200 hover:text-black">
                    
                    <td scope="col" class="px-2 py-3 text-left">
                        {{$item["user"]->name}}
                    </td>
                    <td class="text-left">
                      {{$TOJ[$item["type_of_job"]]}}
                    
                    </td>
                    <td class="text-left">
                        {{$item["user"]->email}}                    
                    </td>
                    <td>
                        {{$status[$item["process_state"]]}}
                    </td>
                    <td class="px-6 text-center">
                        <a wire:click="edit({{ $item->id }})"
                            class="w-full text-green-700 hover:text-white border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-xs px-5  text-center mr-2 ">
                            Edit
                        </a>
                        @if ((!isset($item->register)) or (count($item->register)<=0))
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
