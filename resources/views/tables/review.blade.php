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
                <th class="text-center" >Documents</th>
                <th class="px-2 py-3 text-center">Application Status</th>
                
            </tr>
        </thead>
        <tbody>
            
            @foreach ($lista as $item)
                <tr class="text-center border-b hover:bg-sky-200 hover:text-black" wire:click="Applicant_details({{ $item->id }})">
                    
                    <td scope="col" class="px-2 py-3 text-left">
                        {{$item["user"]->name}}
                    </td>
                    <td class="text-left">
                      {{$TOJ[$item["type_of_job"]]}}
                    
                    </td>
                    <td class="text-center">
                        {{ (isset($item->documents))?count($item->documents):0}}                    
                    </td>
                    <td>
                        {{$status[$item["process_state"]]}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-1">
         
        {{ $lista->links() }}
    
    </div>    
</div>
