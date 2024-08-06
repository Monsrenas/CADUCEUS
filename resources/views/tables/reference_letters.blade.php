@php
    $staText=["awaiting review","Under review", "Approved", "Rejected"];
    
@endphp
<div class="relative h-fit shadow-md sm:rounded-lg">
  
    <div class="mb-4 bg-gray-600 full p-2">
      <p class="uppercase px-4 text-xl text-white">Reference Letters</p>                
    </div>

    <table class="w-full text-sm text-left text-gray-500">
      
        <tbody>
            
            @foreach ( $this->reference_letter as $ind=>$item)
                <tr class="text-center border-b hover:bg-sky-200 hover:text-black"    
                        @if (isset($item[4]))
                            wire:click="ViewLetter({{ $ind }})"
                        @endif >
                   
                    <td scope="col" 
                    @if (isset($item[4]))
                        class="px-2 py-1 text-left text-green-800"
                    @else    
                        class="px-2 py-1 text-left text-red-400"
                    @endif    
                        >
                        @php  
                            $lt=$ind>0?1:0;
                        @endphp  
                        {{$this->LetterType[$lt]}}

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>    
</div>