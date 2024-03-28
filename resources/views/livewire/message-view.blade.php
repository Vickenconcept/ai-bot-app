<div x-data="{ isOpen: false, openNote: false, openSaveModal: false }" id="here" class="mb-32">
    <div class="">
        @if ($errors->any())
            <div class="bg-red-50 text-red-300  p-3 border border-red-300 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <div class="mb-32 mt-10">
            <div id="messages"
                class="flex flex-col space-y-4 p-3 overflow-y-auto scrollbar-thumb-blue scrollbar-thumb-rounded scrollbar-track-blue-lighter scrollbar-w-2 scrolling-touch">
                @foreach ($body as $content)
                    <div class="chat-message">

                        <div class="flex  items-end {{ $content->sender !== 'bot' ? 'justify-end' : '' }}">
                            <div
                                class="flex flex-col space-y-2 text-xs max-w-xs mx-2  {{ $content->sender !== 'bot' ? 'order-1 items-end' : ' order-2 items-start' }}">

                                <div class="flex justify-end   w-full">
                                    <button
                                        class="{{ $content->sender !== 'bot' ? 'hidden' : '' }} {{ auth()->check() ? '' : 'hidden' }} text-gray-400 hover:text-gray-700 "
                                        @click="openNote = true"
                                        onclick="addNote(document.getElementById('{{ $content->id }}'))">
                                        <i
                                            class='bx bx-note bg-purple-300 rounded-full p-2  hover:bg-purple-200 text-purple-50'></i>

                                    </button>
                                    <button class="block h-8 w-8 {{ $content->sender !== 'bot' ? 'hidden' : '' }}"
                                        onclick="toCopy(document.getElementById('{{ $content->id }}'))">
                                        <i
                                            class='bx bx-copy-alt bg-purple-300 rounded-full p-2  hover:bg-purple-200 text-purple-50'></i>
                                    </button>
                                </div>

                                <div>
                                    <span id="{{ $content->id }}"
                                        class="px-4 py-2 rounded-lg inline-block {{ $content->sender !== 'bot' ? 'rounded-br-none bg-purple-300' : 'rounded-bl-none bg-purple-200' }}   text-gray-700">{{ $content->message }}</span>
                                </div>
                                <div class="text-center text-xs ">
                                    <span class="border-b">{{ $content->created_at }}</span>
                                </div>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
        </div>



        <div class=" w-[100%] md:w-[75%] bottom-5  fixed  ">
            <div class=" mx-auto w-32 animate-pulse font-semibold px-20" wire:loading>
                <span>Loading...</span>
                {{-- <img src="{{ asset('image/Blocks.gif') }}" class="h-16 w-16" alt="loading.."> --}}
            </div>
            <div class=" w-full flex justify-center container">
                <div
                    class="w-[90%]   mx-auto  border border-gray-200 rounded-lg bg-gray-50 shadow-md shadow-blue-200  ">
                    <div class="px-4 py-2 bg-white rounded-t-lg ">
                        <form id="messageForm" wire:ignore>
                            @csrf
                            <textarea id="message" rows="2"
                                class="w-full px-2 text-sm text-gray-900 bg-white border-0  focus:ring-transparent focus:outline-none resize-none"
                                placeholder="Ask {{ $conversationTitle->bot->name }}" wire:model.defer="message"></textarea>

                        </form>
                    </div>

                    <div class="flex items-center justify-between px-2  border-t  ">
                        <button @click="isOpen = true"
                            class="bg-gray-50 border ml-2 border-gray-300 text-gray-900 text-sm rounded-lg  block  py-1 px-4  
                        {{ request()->routeIs('guests.show') && auth()->user() ? '' : 'hidden' }} "
                            wire:ignore>{{ $conversationTitle->bot->name }}
                        </button>

                        <div class=" {{ request()->routeIs('conversations.show') ? 'hidden' : '' }}" wire:ignore></div>
                        @if (auth()->check())
                            <div class="flex pl-0 space-x-1 sm:pl-2
                        {{-- {{ request()->routeIs('guests.show') ? 'hidden' : '' }} --}}
                        "
                                wire:ignore>
                                <div class="relative" x-data="{ isOpen: false }">
                                    <button type="button" @click="isOpen = !isOpen"
                                        class="inline-flex justify-center items-center p-2 text-gray-900 rounded cursor-pointer hover:text-gray-900 hover:rotate-45 duration-500  ">
                                        <i class='bx bx-cog'></i>
                                    </button>
                                    <button x-show="isOpen" @click.away="isOpen = false" wire:click="clearMessages"
                                        class=" flex items-center shadow absolute -top-8 -left-12 ml-3 w-32 bg-white hover:bg-red-100 hover:text-red-500 px-4 py-1 rounded-lg">
                                        <i class='bx bx-reset'></i> Clear chat
                                    </button>
                                </div>
                                <button @click="openNote = !openNote"
                                    class="bg-gray-50 border ml-2 border-gray-300 text-gray-900 text-sm rounded-lg  block  py-1 px-4  "><i
                                        class='bx bx-note'></i> Note</span></button>
                                <button @click="isOpen = true"
                                    class="bg-gray-50 border ml-2 border-gray-300 text-gray-900 text-sm rounded-lg  block  py-1 px-4  ">{{ $conversationTitle->bot->name }}</button>
                            </div>
                        @endif
                        <div wire:loading class="text-xl font-bold text-gray-400">
                            <button wire:click="generateContent"
                                class="inline-flex items-center animate-pulse py-2.5 px-4 text-2xl font-medium text-center text-gray-400 rounded-lg hover:text-gray-500">
                                ...
                            </button>
                        </div>
                        <div wire:loading.remove class="text-xl font-bold text-gray-400">
                            <button onclick="startButton(event)" class="" id="start"><i
                                    class='bx bxs-microphone'></i></button>
                            <button onclick="stopButton(event)" class="hidden" id="end"><i
                                    class='bx bxs-microphone text-red-500'></i></button>

                            <button wire:click="generateContent" id="send" {{-- {{ !is_null($message) && !empty($message) ? '' : 'disabled' }} --}}
                                onclick="stopButton(event)"
                                class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-gray-400 rounded-lg hover:text-gray-500">
                                <i class='bx bxs-send text-2xl'></i>
                            </button>
                        </div>

                    </div>
                </div>
            </div>
            {{-- modal --}}

            <div class="fixed items-center justify-center  overflow-auto flex top-0 left-0 mx-auto w-full h-full bg-gray-600 bg-opacity-20 z-10 transition duration-1000 ease-in-out"
                x-show="isOpen" style="display: none;">
                <div @click.away="isOpen = false"
                    class="bg-white w-[80%] lg:w-[40%] h-80  shadow-inner   border rounded-lg overflow-auto  pb-6 px-5 transition-all relative duration-700">
                    <div class="space-y-5 p-5 ">

                        <h1>select bot for chat</h1>

                        <div class=" space-y-1" x-data="{ selected: null }">

                            @foreach ($bot as $bot)
                                <input type="radio" name="personality" wire:model="selectBot"
                                    id="{{ $bot->name }}" value="{{ $bot->id }}" x-model="selected"
                                    wire:change="pickBot" onchange="reloadPage()" hidden>
                                <label for="{{ $bot->name }}"
                                    class="font-semibold upperase w-full block bg-gray-100 border rounded p-2 cursor-pointer  capitalize"
                                    :class="'{{ $conversationTitle->bot->name }}'
                                    === '{{ $bot->name }}' ?
                                        'bg-blue-200 border border-blue-300' : ''"
                                    :class="{
                                        'bg-blue-200 border border-blue-300': selected ===
                                            '{{ $bot->id }}',
                                        '': selected !== '{{ $bot->id }}'
                                    }">{{ $bot->name }}
                                    <span
                                        class="text-gray-50 px-3 ml-1 rounded-full bg-purple-600 font-normal text-sm">{{ $bot->model }}</span></label>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- modal2 --}}
        <div class="fixed items-center justify-center  overflow-auto flex z-50 top-0 left-0 mx-auto w-full h-full bg-gray-600 bg-opacity-20 transition duration-1000 ease-in-out"
            x-show="openSaveModal" style="display: none;">
            <div @click.away="openSaveModal = false"
                class="bg-white w-[80%] lg:w-[50%] h-96  shadow-inner   border rounded-lg overflow-auto  pb-6 px-5 transition-all relative duration-700">
                <div class="space-y-5 p-5 ">
                    <h1>Add To Document</h1>
                    <div class=" space-y-1">
                        <form action="{{ route('documents.store') }}" method="POST" class="space-y-3">
                            @csrf
                            <h1>Title <span class="text-red-400">*</span></h1>
                            <input type="text" class="form-control" name="title" placeholder="Document name">
                            <div class="space-y-3">
                                <h1>Directory <span class="text-red-400">*</span></h1>
                                <div class="grid grid-cols-1 gap-2 overflow-y-auto " x-data="{ selected: null }">
                                    @forelse ($contents as $content)
                                        <label for="{{ $content->title }}" @click="selected =  @js($content->title)"
                                            class=" font-semibold capitalize bg-gray-100 border rounded p-2 cursor-pointer"
                                            :class="{
                                                'bg-purple-100 border border-purple-300': selected ===
                                                    @js($content->title),
                                                '': selected !==
                                                    @js($content->title)
                                            }">
                                            <input type="radio" name="content_id" id="{{ $content->title }}"
                                                value="{{ $content->id }}">
                                            {{ $content->title }}
                                        </label>
                                    @empty
                                        <div class="text-green-400 bg-green-50 border border-green-400 p-3 rounded  ">
                                            <span>Create directory for saving data. </span>
                                            <a href="{{ route('contents.index') }}" class="text-gray-700 underline">
                                                Go
                                                to
                                                contents</a>
                                        </div>
                                    @endforelse
                                    <input type="hidden" name="content" value="" id="contentData">
                                </div>
                                <button type="submit" class="btn-primary">save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div x-show="openNote"
            class="space-y-3 z-10 bg-purple-50 w-full lg:w-1/3 shadow duration-300 transition translate-x fixed top-0 left-0 h-screen pt-20 px-10 "
            style="display: none">
            <div class="flex space-x-2 ">
                <button @click="openNote = false" class=" shadow px-2 py-1 bg-gray-50 rounded hover:bg-purple-200"> <i
                        class="bx bx-x "></i></button>
                <button onclick="toCopy(document.getElementById('note'))"
                    class=" shadow px-2 py-1 bg-gray-50 rounded hover:bg-purple-200"> <i
                        class="bx bx-copy "></i></button>
                <button onclick="clearDiv(document.getElementById('note'))"
                    class=" shadow px-2 py-1 bg-gray-50 rounded hover:bg-purple-200"> <i
                        class='bx bx-recycle'></i></button>
                <x-main-button @click="openSaveModal = true" class="text-gray-50">Save</x-main-button>
            </div>
            <hr>
            <div id="note" class="overflow-y-auto h-full">
                <p> </p>
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
            }

            function clearDiv(copyclearDivDiv) {
                copyclearDivDiv.innerHTML = '';
                document.getElementById('contentData').value = ''

            }

            function addNote(noteData) {
                const note = document.getElementById('note');
                note.innerHTML += "\n" + noteData.textContent + "<br>";
                const contentData = document.getElementById('contentData').value += noteData.textContent;

            }


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

                    // $("#here").load(window.location.href + " #here");
                    location.reload();
                    document.body.scrollTop = document.body.scrollHeight;
                    document.documentElement.scrollTop = document.documentElement.scrollHeight;
                });
            });


            const final_span = document.getElementById('message')
            const interim_span = document.getElementById('interim_span');
            final_span.value = innerHTML = '';

            if (!('webkitSpeechRecognition' in window)) {
                upgrade();
            } else {
                var recognition = new webkitSpeechRecognition();
                // console.log('i have it');
                recognition.continuous = true;
                recognition.interimResults = false;

                recognition.onstart = function() {
                    console.log('onstart');
                }
                recognition.onresult = function(event) {
                    var interim_transcript = '';

                    for (var i = event.resultIndex; i < event.results.length; ++i) {
                        if (event.results[i].isFinal) {
                            final_transcript += event.results[i][0].transcript;
                        } else {
                            interim_transcript += event.results[i][0].transcript;
                        }
                    }
                    // final_transcript = capitalize(final_transcript);
                    final_span.value = addSpace(final_transcript);
                    // interim_span.innerHTML = addSpace(interim_transcript);

                }
                recognition.onerror = function(event) {}
                recognition.onend = function() {
                    console.log('end');
                }
            }

            function addSpace(final_transcript) {
                return final_transcript + " "
            }


            function startButton(event) {
                final_transcript = '';
                recognition.lang = 'en-US';
                recognition.start();
                document.getElementById('start').style.display = 'none';
                document.getElementById('end').style.display = 'unset';
                // document.getElementById('send').disabled = false;
            }

            if (final_span.value === '' || final_span.value === null) {
                document.getElementById('end').style.display = 'none';

            }

            function stopButton(event) {
                final_transcript = '';
                recognition.lang = 'en-US';
                recognition.stop();
                document.getElementById('end').style.display = 'none';
                document.getElementById('start').style.display = 'unset';
            }

            function checkTextAreaValue() {
                console.log(final_span);
            }




            var backendBody = @json($body);
            var gender = @json( optional($conversationTitle->avatar)['gender']);

            const botMessages = backendBody.filter(message => message.sender === 'bot');

            if (botMessages.length > 0) {
                // textToSpeech(botMessages[botMessages.length - 1].message);
                let counter = 0;
                const intervalId = setInterval(() => {
                    if (counter < 2) {
                        textToSpeech(botMessages[botMessages.length - 1].message);
                        counter++;
                    } else {
                        clearInterval(intervalId);
                    }
                }, 2000);
            } else {
                console.log("No bot messages found.");
            }


            function textToSpeech(text) {
                var synthesis = window.speechSynthesis;

                if ('speechSynthesis' in window) {
                    var utterance = new SpeechSynthesisUtterance(text);

                    var voices = synthesis.getVoices();

                    if (voices.length === 0) {
                        synthesis.addEventListener('voiceschanged', function() {
                            voices = synthesis.getVoices();

                        });
                    } else {


                        if (gender == 'female') {
                            var selectedVoice = voices[2]

                        } 
                        if (gender == 'male') {
                            var selectedVoice = voices[1]

                        } 

                        if (selectedVoice) {
                            utterance.voice = selectedVoice;
                            utterance.lang = selectedVoice.lang;
                            utterance.pitch = 1.5;
                            utterance.rate = 1.25;
                            utterance.volume = 0.8;

                            synthesis.speak(utterance);
                        } else {
                            // console.error('No English voice found.');
                        }
                    }
                } else {
                    console.error('Speech synthesis is not supported in this browser.');
                }
            }
        </script>
    </div>

</div>
