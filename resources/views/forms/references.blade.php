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
            <th colspan="5" class="bg-gray-400 text-white">{{$this->grupTitle[$grupInx[9]]}}</th> 
        </tr>
            <th></th>
        @include('forms.assets.InputBox',['ini'=>0,'name'=>'Representative'])
        
        <tr>
            <th colspan="5" class="bg-gray-400 text-white">List 3 people</th> 
        </tr>
        @include('forms.assets.InputBox',['ini'=>1,'name'=>'Name'])
    </tbody>

</table>