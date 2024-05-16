<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Applicant') }}
        </h2>
    </x-slot>
 <style>
    .card{
    background: blueviolet;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.654);
    padding: 16px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    gap: 20px;
    cursor: pointer;
    overflow: hidden;
    transition: all 0.75s ease-in-out;
    color: white;
}
.card:hover{
    background: white;
    box-shadow: 0 0 50px white;
}
</style>

<?php
    $documents= array("HPA application for Registration", "HPA application for Licensure/Renewal", "Curriculum vitae", "Police Record","Copy of passport");
    $colo=array("green","green","orange", "red", "gray");
?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg" >
                <div style=" display: grid; grid-template-columns: 1fr 1fr 1fr;  grid-column-gap: 10px;
                             grid-row-gap: 1em; padding: 14px;">
                    @foreach ($documents as $doc=>$ind )
                        <div class="card" style="background: {{$colo[$doc]}}; display: grid; grid-template-columns: 6fr 1fr;" >
                            {{$ind}}
                            <div style=" text-aling:center; font-size:1.6em;" >&#9745;</div>
                        </div>  
                    @endforeach
                </div>             
            </div>
        </div>
    </div>
</div>