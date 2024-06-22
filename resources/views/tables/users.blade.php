@php
    $status=["Started","Under review","Approved","Rejected"];
    $TOJ=["Administrator","Leader SMT","Committe member"];
    $Lvl=[[],["Chief of Medical Services","Chief of Clinical Service",
          "Chief of Allies Services"],
          ["Medical Services","Clinical Service",
          "Allies Services","Human Resources"]];

@endphp
<div class="relative h-fit shadow-md sm:rounded-lg">
    
    <table class="w-full text-sm text-left text-gray-500 table-auto">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th>
                    Active
                </th>
                <th class="px-2 py-3 text-center">
                    User name
                </th>
                <th class="px-2 py-3 text-center">
                    Role
                </th>
                <th class="text-center" >Email</th>
                
                <th class="px-2 py-3 text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            
            @foreach ($lista as $item)
                <?php $mAccess=json_decode ($item["access"],true); ?>
                <tr class="text-center border-b hover:bg-sky-200 hover:text-black">
                    <td>
                        @if ((auth()->user()->id<>$item->id))
                            <input wire:click='activation({{$item->id}})' {{($item->active)?'checked':''}} type="checkbox"/>
                        @endif     
                    </td>
                    <td scope="col" class="px-2 py-3 text-left">
                        {{$item["name"]}}
                    </td>
                    <td class="text-left">
                      <span class="text-green-600">{{$TOJ[$item["role"]]}}</span>
                      @if (isset($mAccess[9]))
                       
                      <span class="text-xs">{{$Lvl[$item->role][$mAccess[9]]}}</span>   
                      @endif
                    </td>
                    <td class="text-left">
                        {{$item["email"]}}                    
                    </td>
                   
                    <td class="px-6 text-center">

                    @if ((auth()->user()->id<>$item->id))
                        <a wire:click="edit({{ $item->id }})"
                            class="w-full text-green-700 hover:text-white border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-xs px-5  text-center mr-2 cursor-pointer">
                            Edit
                        </a>

                        <a wire:click="ResetPassword({{ $item->id }})" 
                            class="w-full text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-xs px-5  text-center mr-2 cursor-pointer">
                            Reset Password 
                        </a>
                        @endif

                        @if ((auth()->user()->id<>$item->id) and (!isset($item->applicant)))
                        <a wire:click="confirmDelete({{ $item->id }})" 
                            class="w-full text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-xs px-5  text-center mr-2 cursor-pointer">
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
