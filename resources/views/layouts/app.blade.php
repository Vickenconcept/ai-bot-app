<!DOCTYPE html>
<html lang="en" class="h-full bg-white">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ChatBot</title>

    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>


    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>



    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles

</head>

<body class="h-full">
    <div id="ap" class="min-h-screen bg-gray- text-gray-700">

        <x-header />

        {{ $slot }}




    </div>


    <script>
        // function createMessageElement(content, role) {
        //     const messageDiv = 'document.createElement('div')';
        //     messageDiv.className = `message ${role}-message`;
        //     messageDiv.innerText = `${role.charAt(0).toUpperCase() + role.slice(1)}: ${content}`;
        //     return messageDiv;
        // }

        // Function to handle message submission




        function logout(e) {
            localStorage.clear();
            e.closest('form').submit();
        }


        const form = document.querySelector("#form-question");
        const result = document.getElementById("result");
        // const question = document.getElementById("question");
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
            // question.innerText += "\n" + message; // Add a newline after each message
        }
        // 

       

        form.addEventListener("submit", (event) => {
            event.preventDefault();
            const input = event.target.input.value;
            if (input === "") return;

            // question.innerText = input;
            event.target.input.value = "";

            appendMessageForUser("You: " + input);
            // result.innerText = createMessageElement(input, 'user') 

            const queryQuestion = encodeURIComponent(input);
            const source = new EventSource("/ask?question=" + queryQuestion);
            source.addEventListener("update", function(event) {
                console.log(event);
                if (event.data === "<END_STREAMING_SSE>") {
                    source.close();
                    return;
                }
                // result.innerText += event.data + " \n";

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
                // appendMessage(event.data);
                // const responseLines = event.data.split('\n');
                // responseLines.forEach(line => {
                //     if (line.trim() !== '') {
                //         appendMessage("AI: " + line.trim());
                //     }
                // });
            };

            source.onerror = (error) => {
                console.error('EventSource failed: ', error);
            };
        });


        // Retrieve and display previous messages from local storage
        // const previousMessages = JSON.parse(localStorage.getItem('chatMessages')) || [];
        // previousMessages.forEach((message) => {
        //     appendMessage(message);
        // });

        // // Store messages in local storage
        // window.addEventListener('beforeunload', () => {
        //     const messages = result.innerText.split('\n');
        //     localStorage.setItem('chatMessages', JSON.stringify(messages));
        // });






        // const form = document.querySelector("#form-question");
        // const result = document.getElementById("result");

        // form.addEventListener("submit", (event) => {
        //     event.preventDefault();
        //     const input = event.target.input.value;
        //     if (input === "") return;
        //     const question = document.getElementById("question");
        //     question.innerText = input;
        //     event.target.input.value = "";
        //     const queryQuestion = encodeURIComponent(input);
        //     const source = new EventSource("/ask?question=" + queryQuestion);
        //     source.addEventListener("update", function(event) {
        //         console.log(event);
        //         if (event.data === "<END_STREAMING_SSE>") {
        //             source.close();
        //             return;
        //         }
        //         result.innerText += event.data + " \n";
        //     });
        //     // -----
        //     source.onmessage = (event) => {
        //         console.log('Received data: ', event.data);
        //         // Handle the received data as needed
        //         result.innerText += event.data;
        //         if (event.data === "<END_STREAMING_SSE>") {
        //             source.close();
        //             return;
        //         }
        //     };
        //     source.onerror = (error) => {
        //         console.error('EventSource failed: ', error);
        //     };
        // });
    </script>


    @livewireScripts

</body>



</html>
