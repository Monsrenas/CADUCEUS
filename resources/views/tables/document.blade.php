<div style=" display: grid; grid-template-columns: 1fr 1fr 1fr;  grid-column-gap: 10px;
                             grid-row-gap: 1em; padding: 14px;">

                    <div wire:click="ReferenceDetail" class="card font-medium text-sm" style="background: blue; display: grid; grid-template-columns: 9fr 1fr;" >
                        List of people for reference letters
                                    <div style=" text-aling:center; font-size:.8em; color:yellow" > 
                                        0 of 3
                                    </div>
                    </div>        
                    
                    
                    @foreach ($doc_list as $doc=>$ind )
                        @php
                        $Ic=3;
                           if (isset($ind->documents)and(count($ind->documents)>0)) {$Ic=0;}
                        @endphp
                            
                        @if (isset($ind->documents)and(count($ind->documents)>0))
                            @foreach ($ind->documents as $xdoc )
                                <div wire:click="DocDetail('{{$xdoc->id}}','{{$ind->id}}')" class="card font-medium text-sm" style="background: {{$colo[$Ic]}}; display: grid; grid-template-columns: 12fr 1fr;" >
                                    {{$ind->name}}
                                    <div style=" text-aling:center; font-size:1.6em;" > 
                                        &#{{$status[$xdoc->state]}}; 
                                    </div>
                                </div>      
                                @endforeach 
                            @else
                                <div wire:click="DocDetail('','{{$ind->id}}')" class="card font-medium text-sm" style="background: {{$colo[$Ic]}}; display: grid; grid-template-columns: 12fr 1fr;" >
                                    {{$ind->name}}
                                    <div style=" text-aling:center; font-size:1.6em;" > 
                                         
                                    </div>
                                </div>    
                            @endif    
                    @endforeach
    </div>      