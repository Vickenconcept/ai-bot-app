<!DOCTYPE html>
<html lang="en" class="h-full bg-white">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('image/favicon.ico') }}">

    <title>ChatBot</title>

    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>


    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>



    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    <link rel="stylesheet" href="{{ asset('build/assets/app-171b3f1e.css') }}">
    <link rel="stylesheet" href="{{ asset('build/assets/app-a461d729.css') }}">
    <script src="{{ asset('build/assets/app-11155cd2.js') }}"></script>

    @livewireStyles
</head>

<body class="h-full">
    <div id="ap" class="min-h-screen bg-gray- text-gray-700" x-data="{ openHelp: false }">

        <x-header />
        <x-pre-loader />
        {{ $slot }}



    </div>


    <script>
        var synthesis = window.speechSynthesis;




        // document.addEventListener('DOMContentLoaded', function() {
        //     if ('speechSynthesis' in window) {
        //         var synthesis = window.speechSynthesis;

        //         // Regex to match all English language tags e.g en, en-US, en-GB
        //         var langRegex = /^en(-[a-z]{2})?$/i;

        //         // Get the available voices and filter the list to only have English speakers

        //         synthesis.onvoiceschanged = function() {
        //             var voices = synthesis.getVoices().filter((voice) => langRegex.test(voice.lang));

        //             // Log the properties of the voices in the list
        //             voices.forEach(function(voice) {
        //                 // console.log({
        //                 //     name: voice.name,
        //                 //     lang: voice.lang,
        //                 //     uri: voice.voiceURI,
        //                 //     local: voice.localService,
        //                 //     default: voice.default,
        //                 // });
        //             });



        //             var voice = voices.find(function(voice) {
        //                 return voice.lang.includes('en');
        //             });


        //             // Create an utterance object
        //             var utterance = new SpeechSynthesisUtterance('We are not Available right now.');

        //             // utterance.text = "My name is Eleazar Nzerem.";

        //             // Set utterance properties
        //             utterance.lang = 'en'; // Set the language
        //             utterance.voice = voice;
        //             utterance.pitch = 1.5;
        //             utterance.rate = 1.25;
        //             utterance.volume = 0.8;


        //             utterance.onstart = function() {
        //                 console.log('Speech synthesis started.');
        //             }

        //             utterance.onend = function() {
        //                 console.log('Speech synthesis complete.');
        //             }

        //             utterance.onerror = function(event) {
        //                 console.error('Speech synthesis error:', event.error);
        //             }


        //             // Speak the utterance
        //             synthesis.speak(utterance);
        //         };


        //     } else {
        //         console.log('Text-to-speech not supported.');
        //     }

        //     console.log('helo');
        // });

        // function textToSpeach() {
        //     // Wrap your code in a DOMContentLoaded event listener
        //     document.addEventListener('DOMContentLoaded', function() {
        //         // Your speech synthesis code here
        //         var synthesis = window.speechSynthesis;

        //         // Check if speech synthesis is supported
        //         if ('speechSynthesis' in window) {
        //             // Create a new SpeechSynthesisUtterance
        //             var utterance = new SpeechSynthesisUtterance('Hello, I am speaking!');

        //             // Set the voice and other properties
        //             var voices = synthesis.getVoices();
        //             var voice = voices.find(function(voice) {
        //                 return voice.lang.includes('en');
        //             });

        //             if (voice) {
        //                 utterance.voice = voice;
        //                 utterance.lang = 'en'; // Set the language
        //                 utterance.pitch = 1.5;
        //                 utterance.rate = 1.25;
        //                 utterance.volume = 0.8;

        //                 // Speak the utterance
        //                 synthesis.speak(utterance);
        //             } else {
        //                 console.error('No English voice found.');
        //             }
        //         } else {
        //             console.error('Speech synthesis is not supported in this browser.');
        //         }
        //     });
        //     console.log('onning');


        // }
        // textToSpeach()


        // function textToSpeech() {
        //     // Your speech synthesis code here
        //     var synthesis = window.speechSynthesis;

        //     // Check if speech synthesis is supported
        //     if ('speechSynthesis' in window) {
        //         // Create a new SpeechSynthesisUtterance
        //         var utterance = new SpeechSynthesisUtterance('Hello, I am speaking!');

        //         // Set the voice and other properties
        //         var voices = synthesis.getVoices();
        //         var voice = voices.find(function(voice) {
        //             return voice.lang.includes('en');
        //         });

        //         if (voice) {
        //             utterance.voice = voice;
        //             utterance.lang = 'en'; // Set the language
        //             utterance.pitch = 1.5;
        //             utterance.rate = 1.25;
        //             utterance.volume = 0.8;

        //             // Speak the utterance
        //             synthesis.speak(utterance);
        //         } else {
        //             console.error('No English voice found.');
        //         }
        //     } else {
        //         console.error('Speech synthesis is not supported in this browser.');
        //     }
        // }

        // document.getElementById('speakButton').addEventListener('click', textToSpeech);










        // -------- //

        function logout(e) {
            localStorage.clear();
            e.closest('form').submit();
        }


        const form = document.querySelector("#form-question");
        const result = document.getElementById("result");
        const question = document.getElementById("question");

        // 
        function appendMessage(message) {
            let formattedMessage = "\n AI: " + message;
            let newMessage = formattedMessage;
            const newDiv = document.createElement('div');
            newDiv.innerText = "\n" + formattedMessage;

            result.appendChild(newDiv);

            // result.innerText = newMessage;
            result.scrollTop = result.scrollHeight;
        }


        function appendMessageForUser(message) {
            const newDiv = document.createElement('div');
            newDiv.innerText = "\n" + message;

            result.appendChild(newDiv);
        }
        // 



        form.addEventListener("submit", (event) => {
            event.preventDefault();
            const input = event.target.input.value;
            if (input === "") return;

            // question.innerText = input;
            event.target.input.value = "";

            appendMessageForUser("You: " + input);

            const queryQuestion = encodeURIComponent(input);
            const source = new EventSource("/ask?question=" + queryQuestion);
            source.addEventListener("update", function(event) {
                console.log(event);
                if (event.data === "<END_STREAMING_SSE>") {
                    source.close();
                    return;
                }

            });
            // -----
            let accumulatedMessage = '';
            source.onmessage = (event) => {
                console.log('Received data: ', event.data);
                // Handle the received data as needed
                // result.innerText += event.data;

                if (event.data === "<END_STREAMING_SSE>") {
                    source.close();
                    return;
                }
                accumulatedMessage += event.data + ' ';
                appendMessage(accumulatedMessage)

            };

            source.onerror = (error) => {
                console.error('EventSource failed: ', error);
            };
        });
    </script>

    @livewireScripts

</body>



</html>
