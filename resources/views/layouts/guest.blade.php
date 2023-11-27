<!DOCTYPE html>
<html lang="en" class="h-full bg-white">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('image/favicon.ico') }}">

    <title>ChatBot</title>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    <link rel="stylesheet" href="{{ asset('build/assets/app-2addb739.css') }}">
    <link rel="stylesheet" href="{{ asset('build/assets/app-a461d729.css') }}">
    <script src="{{ asset('build/assets/app-11155cd2.js') }}"></script>

</head>

<body class="h-full">
    {{ $slot }}

</body>

<script>
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
</script>

</html>
