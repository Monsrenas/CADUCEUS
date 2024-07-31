

<div class="">  
        <div class="flex flex-col md:flex-row pb-4 mb-2">
            <div class="flex-1">
                <div class="flex flex-col md:flex-row">
                    <select class="block p-2.5  z-20 text-sm text-gray-900 bg-gray-50 rounded-lg  border-s-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-s-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500 form-select " wire:model='xGroup' >
                        <option value="" selected >All groups</option>
                        @foreach ($Lvl as $ind=>$itm)
                            <option value="{{$ind}}">{{$itm}}</option>
                        @endforeach
                    </select>
                    <div class=" flex-1 mx-2 h-11">
                        <div class="relative w-full">
                            <div type="submit" class="absolute top-0 start-0  p-2.5 text-sm font-medium h-full text-white bg-gray-50 border-e-0 rounded-lg rounded-e-none border border-gray-300 focus:outline-none  dark:bg-blue-600 dark:hover:bg-blue-700 ">
                                &#128270; 
                            </div>
                            <input placeholder="Name"  wire:model='xName' class="mx-8  p-2.5 w-ajust z-20 text-sm text-gray-900 bg-gray-50 border-s-0 rounded-lg  border-s-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-s-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500"> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>