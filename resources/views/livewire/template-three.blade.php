<div class="mt-20 pb-10">
    <div class="w-full px-5 flex flex-col justify-between" x-data="{ isOpen: null, openLast: false, contactType: true }">

        <div class="flex flex-col mt-5">

            @foreach ($history as $key => $response)
                @if ($loop->iteration <= $secondToLastIndex)
                    <div class="flex justify-start mb-4">
                        <span class="h-8 w-8 rounded-full flex justify-center items-center font-bold  bg-green-100 "><i
                                class='bx bxs-bot text-2xl '></i></span>
                        <div id="chatCol1"
                            class="ml-2 py-3 px-4 text-purple-50 rounded-br-3xl rounded-bl-3xl rounded-tr-3xl" 
                            style="background-color: {{ $conversationTitle->nav_bg_color }}; color: {{ $conversationTitle->nav_col }}">
                            {{ $response }}
                        </div>
                    </div>
                    {{--  --}}
                    @if ($key == 0)
                        <div class="flex justify-end mb-4">
                            <div
                                class="mr-2 py-3 px-4 gap-3 text-gray-70 rounded-tl-3xl rounded-bl-3xl rounded-br-3xl  ">
                                <button onclick="test()"
                                    class="shadow-sm hover:shadow-md px-5 py-2 w-full bg-gray-50 rounded-md border font-semibold">Continue...</button>
                                <button onclick="test()"
                                    class="shadow-sm hover:shadow-md px-5 py-2 w-full bg-gray-50 rounded-md border font-semibold">Proceed...</button>
                            </div>
                            {{-- <span
                                class="h-8
                        w-8 rounded-full flex justify-center items-center font-bold bg-green-100 ">
                                ME
                            </span> --}}
                        </div>
                    @endif
                    {{--  --}}
                    @if ($loop->iteration == $secondToLastIndex)
                        <div class="flex space-x-5 pl-10" x-show="contactType">
                            <x-main-button class="text-gray-50"
                                style="background-color: {{ $conversationTitle->nav_bg_color }}; color: {{ $conversationTitle->nav_col }}"
                                @click="isOpen = 'email', contactType=false">email</x-main-button>
                            <x-main-button
                                style="background-color: {{ $conversationTitle->nav_bg_color }}; color: {{ $conversationTitle->nav_col }}"
                                class="text-gray-50" @click="isOpen ='number', contactType=false">phone
                                number</x-main-button>
                        </div>
                        <div class="pl-10">
                            <form wire:submit>
                                <div class="py-5 flex items-center" x-show=" isOpen === 'email'">
                                    <input class="form-control flex-grow" wire:model.live="email" type="email"
                                        placeholder="Enter your email here" />
                                    <div class="flex-initial ml-1">

                                        @if ($email !== '' && $email !== null)
                                            <x-main-button onclick="lastResponse ()"
                                                style="background-color: {{ $conversationTitle->nav_bg_color }}; color: {{ $conversationTitle->nav_col }}"
                                                class="text-gray-50 " @click="openLast = true, isOpen=null"
                                                wire:click="subscribe">Submit</x-main-button>
                                        @endif
                                    </div>
                                </div>
                            </form>
                            <form wire:submit>
                                <div class="py-5 flex items-center" x-show=" isOpen === 'number'">
                                    <input class="form-control" wire:model.live="phoneNumber" type="number"
                                        placeholder="Enter your number here" />
                                    <div class="flex-initial ml-1">
                                        @if ($phoneNumber !== '' && $phoneNumber !== null)
                                            <x-main-button onclick="lastResponse ()"
                                                style="background-color: {{ $conversationTitle->nav_bg_color }}; color: {{ $conversationTitle->nav_col }}"
                                                class="text-gray-50 " @click="openLast = true, isOpen=null"
                                                wire:click="subscribe">Submit</x-main-button>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    @endif
                @endif
            @endforeach
            <div class="flex justify-end mb-4" x-show="openLast">
                <div class="mr-2 py-3 px-4 bg-purple-800 text-purple-50 rounded-tl-3xl rounded-bl-3xl rounded-br-3xl  "
                    style="background-color: {{ $conversationTitle->nav_bg_color }}; color: {{ $conversationTitle->nav_col }}">
                    {{ $email }} {{ $phoneNumber }}
                </div>
                <span
                    class="h-8
                    w-8 rounded-full flex justify-center items-center font-bold bg-green-100 ">
                    ME
                </span>
            </div>
            <div class="flex justify-start mb-4" x-show="openLast">
                <span class="h-8 w-8 rounded-full flex justify-center items-center font-bold  bg-green-100 "><i
                        class='bx bxs-bot text-2xl '></i></span>
                <div class="ml-2 py-3 px-4 bg-purple-200 text-purple-50 rounded-br-3xl rounded-bl-3xl rounded-tr-3xl "
                    style="background-color: {{ $conversationTitle->nav_bg_color }}; color: {{ $conversationTitle->nav_col }}">
                    {{ $chatData[$secondToLastIndex] }}
                </div>
            </div>
        </div>
    </div>
    <script>
        var index = -2
        var text = @json($chatData);

        function test() {
            setInterval(() => {
                if (text.length >= index + 2) {

                    index += 1

                    if (index <= text.length - 2) {

                        textToSpeech("'" + text[index] + "'")
                    }
                   

                    if (index > 0) {
                        @this.dispatch('nextResponse');
                    }
                    // window.scrollTo(0, document.body.scrollHeight);
                    document.body.scrollTop = document.body.scrollHeight;
                    document.documentElement.scrollTop = document.documentElement.scrollHeight;
                }
            }, 4000);
        }

        function lastResponse (){
            textToSpeech("'" + text[text.length - 1] + "'")
        }

        // window.addEventListener('DOMContentLoaded', () => {
        // })

        var gender = @json($conversationTitle->avatar['gender']);

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

                    } else {
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
                        console.error('No English voice found.');
                    }
                }
            } else {
                console.error('Speech synthesis is not supported in this browser.');
            }
        }
    </script>
</div>
