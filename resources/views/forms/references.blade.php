 <table class="w-full">
    <thead>
        <th width="5%"></th>
        <th width="10%"></th>
        <th></th>
    </thead>  
    @php
        $grupInx=json_decode( auth()->user()->access,true);
    @endphp
    <tbody>
        <tr>
            <th colspan="5" class="bg-gray-400 text-white">Good Standing</th> 
        </tr>
            <th></th>
       {{-- @include('forms.assets.InputBox',['ini'=>0,'name'=>'Representative']) --}}
        <tr>
            <td colspan="5">
                <p class="my-3 mx-2 font-bold"> Dear Applicant,
                    You will be required to request that a letter of Good Standing be emailed directly using the email address <span class="font-semibold text-blue-500">Hpareferences@gov.tc</span>  and addressed to:  </p>
               
                <ul class="list-none  mb-3 mx-6" style="list-style-position: outside;">
                    <li>The Chair</li>
                    <li>    {{$this->grupTitle[$grupInx[9]]}}  </li>
                    <li> The Health Professions Authority </li>
                    <li>The Ministry of Health, Turks and Caicos Islands 23 Parade Ave Providenciales Turks and Caicos Islands</li>
                </ul>
            </td>
        </tr>  
        
        <tr>
            <th colspan="5" class="bg-gray-400 text-white">Reference Letters</th> 
        </tr>
        <tr>
            <td colspan="5">
                <p class="my-3 mx-2 font-bold">
                 Please <span class="bg-blue-500 text-white px-2 rounded-full">add</span> the data of 3 people who are being asked for reference letters on to behalf
                </p>
            </td>
        </tr>
        @include('forms.assets.InputBox',['ini'=>1,'name'=>'Name'])
    </tbody>

</table>