<div>
    {{-- <div class="w-full px-5 flex flex-col justify-center items-center space-y-6"> --}}
    {{-- @if ($page == 1) --}}
    <div class="pt-20 pb-10  flex flex-col  justify-center items-center  space-y-6 bg-purple-50 h-screen"
        @if ($page != 1) style="display: none" @endif>


        <h1 class="font-bold text-xl tracking-wide">Book An Appointment</h1>

        <form wire:submit="submitAppointment"
            class="space-y-5 bg-purple-200 px-5 py-10 rounded-lg w-full mx-auto lg:w-[40%]">

            <div>
                <label for="name" class="text-xs font-semibold">Enter Your Name</label>
                <input type="text" name="name" class="form-control" placeholder="Your name" wire:model="name">
            </div>
            <div>
                <label for="email" class="text-xs font-semibold">Enter Your Email</label>
                <input type="text" name="email" class="form-control" placeholder="Your Email" wire:model="email">
            </div>
            <div>
                <div class="flex items-center space-x-4">
                    <div class="w-1/2 pr-4 flex-wrap">
                        <label for="" class="text-xs font-semibold">Start Date</label>
                        <input type="datetime-local" name="start_date" id="start_date"
                            class="w-full block rounded-md border-0" wire:model.live="start_date"
                            max="{{ $end_date }}" placeholder="Start Date">
                    </div>
                    <div class="w-1/2 pr-4 flex-wrap">
                        <label for="" class="text-xs font-semibold">End Date</label>
                        <input type="datetime-local" name="end_date" id="end_date"
                            class="w-full block rounded-md border-0" @if ($start_date == null) disabled @endif
                            wire:model.live="end_date" min="{{ $start_date }}" placeholder="End Date">
                    </div>
                </div>

            </div>
            <div class="w-full">
                <textarea name="" id="" rows="3" wire:model="comments" class="w-full rounded-lg border-0 p-3">
                
            </textarea>
            </div>

            <button type="button" wire:click="submitAppointment" class="btn-primary flex items-center"><i
                    class="bx bx-send mr-2"></i>Send</button>

        </form>


    </div>
    <div class="pt-20 pb-10  flex flex-col  justify-center items-center  space-y-6 bg-purple-50 h-screen"
        @if ($page != 2) style="display: none" @endif>

        <!-- component -->
        <div class="bg-gray-100 h-screen">
            <div class="bg-white p-6  md:mx-auto">
                <svg viewBox="0 0 24 24" class="text-green-600 w-16 h-16 mx-auto my-6">
                    <path fill="currentColor"
                        d="M12,0A12,12,0,1,0,24,12,12.014,12.014,0,0,0,12,0Zm6.927,8.2-6.845,9.289a1.011,1.011,0,0,1-1.43.188L5.764,13.769a1,1,0,1,1,1.25-1.562l4.076,3.261,6.227-8.451A1,1,0,1,1,18.927,8.2Z">
                    </path>
                </svg>
                <div class="text-center">
                    <h3 class="md:text-2xl text-base text-gray-900 font-semibold text-center">Sent</h3>
                    <p class="text-gray-600 my-2">Thanks for the request, we will contact you soon</p>
                    <p> Have a great day! </p>
                    <div class="py-10 text-center">
                        <a href="#" wire:click="moveToPage(1)"
                            class="px-12 bg-indigo-600 hover:bg-indigo-500 text-white font-semibold py-3">
                            GO BACK
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
       

        let counter = 0;
        const intervalId = setInterval(() => {
            if (counter < 3) {
                textToSpeech('You are welcome, Please book an appointment')
                counter++;
            } else {
                clearInterval(intervalId);
            }
        }, 4000);

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
