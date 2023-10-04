<div x-data="{ isOpen: false }" id="here" class="mb-32">
    <div class="">
        <ul class=" mb-32">
            @foreach ($body as $content)
                <div class="{{ $content->sender !== 'bot' ? 'bg-white' : 'bg-gray-100' }}">
                    <div class="flex justify-between  py-10 w-[90%] md:w-[70%] mx-auto ">
                        <div class=" flex space-x-5">
                            <img class="h-8 w-8 rounded-full"
                                src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                alt="">
                            <li class="" id="{{ $content->id }}">{{ $content->message }}</li>
                        </div>
                        <button class="block h-8 w-8 {{ $content->sender !== 'bot' ? 'hidden' : '' }}"
                            onclick="toCopy(document.getElementById('{{ $content->id }}'))">
                            <i class='bx bx-copy-alt text-gray-400'></i>
                        </button>
                    </div>
                </div>
            @endforeach


        </ul>


        {{--  --}}

        <div class=" w-[100%] md:w-[75%] bottom-5  fixed  ">
            <div class=" w-full flex justify-center container">
                <div
                    class="w-[90%]   mx-auto  border border-gray-200 rounded-lg bg-gray-50 shadow-md shadow-blue-200  ">
                    <div class="px-4 py-2 bg-white rounded-t-lg ">
                        <form  id="messageForm" wire:ignore>
                            @csrf
                            <textarea id="message" rows="2"
                                class="w-full px-2 text-sm text-gray-900 bg-white border-0  focus:ring-transparent focus:outline-none resize-none"
                                placeholder="Ask {{ $conversationTitle->bot->name }}" wire:model.live="message"></textarea>
                        </form>
                    </div>

                    <div class="flex items-center justify-between px-2  border-t  ">
                        <button @click="isOpen = true"
                            class="bg-gray-50 border ml-2 border-gray-300 text-gray-900 text-sm rounded-lg  block  py-1 px-4  
                        {{ request()->routeIs('guests.show') && auth()->user() ? '' : 'hidden' }} "
                            wire:ignore>{{ $conversationTitle->bot->name }}
                        </button>

                        <div class=" {{ request()->routeIs('conversations.show') ? 'hidden' : '' }}" wire:ignore></div>
                        <div class="flex pl-0 space-x-1 sm:pl-2 {{ request()->routeIs('guests.show') ? 'hidden' : '' }}"
                            wire:ignore>
                            <button type="button"
                                class="inline-flex justify-center items-center p-2 text-gray-900 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 ">
                                <i class='bx bx-cog'></i>
                            </button>
                            <button type="button"
                                class="inline-flex justify-center items-center p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 ">
                                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 16 20">
                                    <path
                                        d="M8 0a7.992 7.992 0 0 0-6.583 12.535 1 1 0 0 0 .12.183l.12.146c.112.145.227.285.326.4l5.245 6.374a1 1 0 0 0 1.545-.003l5.092-6.205c.206-.222.4-.455.578-.7l.127-.155a.934.934 0 0 0 .122-.192A8.001 8.001 0 0 0 8 0Zm0 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z" />
                                </svg>
                                <span class="sr-only">Set location</span>
                            </button>

                            <button
                                class="bg-gray-50 border ml-2 border-gray-300 text-gray-900 text-sm rounded-lg  block  py-1 px-4  "><i
                                    class='bx bx-target-lock'></i> Target</span></button>
                            <button
                                class="bg-gray-50 border ml-2 border-gray-300 text-gray-900 text-sm rounded-lg  block  py-1 px-4  "
                                onclick="updateDiv()"><i class='bx bx-note'></i> Note</span></button>
                            <button @click="isOpen = true"
                                class="bg-gray-50 border ml-2 border-gray-300 text-gray-900 text-sm rounded-lg  block  py-1 px-4  ">{{ $conversationTitle->bot->name }}</button>




                        </div>
                        <div wire:loading class="text-xl font-bold text-gray-400">
                            <button wire:click="generateContent"
                                class="inline-flex items-center py-2.5 px-4 text-2xl font-medium text-center text-gray-400 rounded-lg hover:text-gray-500">
                                ...
                            </button>
                        </div>
                        <div wire:loading.remove class="text-xl font-bold text-gray-400">

                            <button wire:click="generateContent"
                                {{ !is_null($message) && !empty($message) ? '' : 'disabled' }}
                                class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-gray-400 rounded-lg hover:text-gray-500">
                                <i class='bx bxs-send text-2xl'></i>
                            </button>
                        </div>

                    </div>
                </div>
            </div>

            <div class="fixed items-center justify-center  overflow-auto flex top-0 left-0 mx-auto w-full h-full bg-gray-600 bg-opacity-20 z-10 transition duration-1000 ease-in-out"
                x-show="isOpen" style="display: none;">
                <div @click.away="isOpen = false"
                    class="bg-white w-[70%] lg:w-[40%] h-80  shadow-inner   border rounded-lg overflow-auto  pb-6 px-5 transition-all relative duration-700">
                    <div class="space-y-5 p-5 ">

                        <h1>select bot for chat</h1>

                        <div class=" space-y-1" x-data="{ selected: null }">

                            @foreach ($bot as $bot)
                                <input type="radio" name="personality" wire:model="selectBot"
                                    id="{{ $bot->name }}" value="{{ $bot->id }}" x-model="selected"
                                    wire:change="pickBot" onchange="reloadPage()" hidden>
                                <label for="{{ $bot->name }}"
                                    class="font-semibold upperase w-full block bg-gray-100 border rounded p-2 cursor-pointer  capitalize"
                                    :class="'{{ $conversationTitle->bot->name }}' === '{{ $bot->name }}' ?
                                    'bg-blue-200 border border-blue-300' : ''"
                                    :class="{
                                        'bg-blue-200 border border-blue-300': selected ===
                                            '{{ $bot->id }}',
                                        '': selected !== '{{ $bot->id }}'
                                    }">{{ $bot->name }}</label>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>


        </div>



        <script>
            // for coping text
            function toCopy(copyDiv) {
                var range = document.createRange();
                range.selectNode(copyDiv);
                window.getSelection().removeAllRanges();
                window.getSelection().addRange(range);
                document.execCommand("copy");
                // alert("copied!");
            }



            // setInterval(refreshDiv, 1000);
            function reloadPage() {
                setTimeout(function() {
                    window.location.reload();
                }, 300);
            }

            window.onload = function() {
                // window.scrollTo(0, document.body.scrollHeight);
                document.body.scrollTop = document.body.scrollHeight;
                document.documentElement.scrollTop = document.documentElement.scrollHeight;
            };

            function updateDiv() {
                // window.scrollTo(0, document.body.scrollHeight);
                $("#here").load(window.location.href + " #here");
                document.body.scrollTop = document.body.scrollHeight;
                document.documentElement.scrollTop = document.documentElement.scrollHeight;
                console.log('hello');
            }




            document.addEventListener('livewire:initialized', function() {
                @this.on('refreshComponent', (data) => {

                    $("#here").load(window.location.href + " #here");
                    document.body.scrollTop = document.body.scrollHeight;
                    document.documentElement.scrollTop = document.documentElement.scrollHeight;
                });
            });
        </script>
    </div>

</div>
