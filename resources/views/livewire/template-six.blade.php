<div class="mt-20 pb-10" x-data="{ isOpen: null }">
    <div class="w-full px-5 flex flex-col justify-between">
        <div class="flex flex-col mt-5">
            @if (isset($data))
                <div class=" space-y-5 ">
                    @foreach ($data as $key => $result)
                        <div class="" id="{{ $key }}" class="">
                            <div class="flex justify-start mb-4" x-show="isOpen !== @js($key)">
                                <span
                                    class="h-8 w-8 rounded-full flex justify-center items-center font-bold  bg-green-100 "><i
                                        class='bx bxs-bot text-2xl '></i></span>
                                <button
                                    class="text-gray-50 shadow hover:shadow-md px-5 py-2 rounded hover:opacity-50 font-semibold capitalize"
                                    style="background-color: {{ $conversationTitle->nav_bg_color }}; color: {{ $conversationTitle->nav_col }}"
                                    style="display: none;" @click="isOpen = @js($key)"
                                    >{{ $result->question }} <i
                                        class="bx bx-chevron-down"></i></button>
                            </div>

                            <div class="flex justify-start mb-4" x-show="isOpen === @js($key)">
                                <span 
                                    class="h-8 w-8 rounded-full flex justify-center items-center font-bold  bg-green-100 "><i
                                        class='bx bxs-bot text-2xl '></i></span>

                                <button
                                    class="text-gray-50 shadow hover:shadow-md px-5 py-2 rounded hover:opacity-50 font-semibold capitalize"
                                    style="background-color: {{ $conversationTitle->nav_bg_color }}; color: {{ $conversationTitle->nav_col }}"
                                    style="display: none;" @click="isOpen = null"
                                    >{{ $result->question }} <i
                                        class="bx bx-chevron-up"></i></button>
                            </div>

                            <div style="display: none;" x-show="isOpen === @js($key)"
                                class="p-3 bg-gray-200 mt-2 ml-10">{{ $result->answer }}</div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="flex justify-center">
                    <p class="text-2xl font-bold text-gray-700">No data yet, come back later</p>
                </div>
            @endif


        </div>
    </div>

</div>
