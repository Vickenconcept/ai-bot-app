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


    {{-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script> --}}

    <script src="https://code.jquery.com/jquery-3.6.0.min.js " defer></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>



    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    <link rel="stylesheet" href="{{ asset('build/assets/app-a461d729.css') }}">
    <link rel="stylesheet" href="{{ asset('build/assets/app-2addb739.css') }}">
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
