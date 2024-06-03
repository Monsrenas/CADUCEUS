@php
    $status=["Started","Under review","Approved","Rejected"];
    $TOJ=["Full time","Locum","Visiting"];
    $Lvl=["Medical Services","Clinical Service","Allies Services"];
    
@endphp

<div class="relative h-fit shadow-md sm:rounded-lg">
    <select   wire:model='xGroup' 
        class="mb-4 bg-gray-200 appearance-none border-2 border-gray-200 rounded w-max py-2  text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-green-500">
        <option value=""  selected >All groups</option>
        @foreach ($Lvl as $ind=>$itm)
            <option value="{{$ind}}">{{$itm}}</option>
        @endforeach
    </select>

    <table class="w-full text-sm text-left text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th class="px-2 py-3 text-center">
                    Applicant name
                </th>
                <th>
                    Type
                </th>
                <th class="text-center"> Group</th>
                <th class="text-center" >Documents</th>
                <th class="px-2 py-3 text-center">Application Status</th>
                
            </tr>
        </thead>
        <tbody>
            
            @foreach ($lista as $item)
                <?php  
                    $mAccess=json_decode ($item->access,true); 
                    $UserAccess=json_decode (auth()->user()->access,true);
                ?>
                <tr  
                   @if (isset($UserAccess[9])and($UserAccess[9]==$mAccess[9]))     
                    class="text-center border-b hover:bg-sky-200 hover:text-black "
                    wire:click="Applicant_details({{ $item->applicant->id }})"
                  @else
                    class="text-center border-b "
                  @endif  >
                    <td scope="col" class="px-2 py-3 text-left">
                         {{$item->name}}
                    </td>
                    <td class="text-left">
                      {{$TOJ[$item["applicant"]->type_of_job]}}
                    </td>
                    <td>
                        
                        @if (isset($mAccess[9]))                       
                            <span >{{$Lvl[$mAccess[9]]}}</span>   
                        @endif
                    </td>
                    <td class="text-center">
                        {{ (isset($item->documents))?count($item->documents):0}}                    
                    </td>
                    <td>
                        {{$status[$item["applicant"]->process_state]}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-1">
         
        {{ $lista->links() }}
    
    </div>    
   
</div>
