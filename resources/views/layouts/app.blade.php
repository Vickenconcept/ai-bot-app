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
    {{-- <script>
        window.codySettings = { widget_id: '9a136341-8616-4af5-b6e8-ab72fb2a9dd5' };
        
        !function(){var t=window,e=document,a=function(){var t=e.createElement("script");t.type="text/javascript",t.async=!0,t.src="https://trinketsofcody.com/cody-widget.js";var a=e.getElementsByTagName("script")[0];a.parentNode.insertBefore(t,a)};"complete"===document.readyState?a():t.attachEvent?t.attachEvent("onload",a):t.addEventListener("load",a,!1)}();
        </script> --}}



</head>

<body class="h-full">
    <div id="ap" class="min-h-screen bg-gray- text-gray-700" x-data="{ openHelp: false }">

        <x-header />
        {{-- <span x-text="openHelp"></span> --}}
        <div x-show="openHelp"
         class="bg-red-500 p-20 fixed z-50 w-72 " 
        style="display: none
            left: 20px;
            box-shadow: 3px 3px 6px lightgray ; 
            border: 3px solid darkblue; 
            border-radius: 10px;
            display: none;
            background-color: #fff; 
            height:500px;
        ">
            <button @click="openHelp = false"><i class="bx bx-x"></i></button>
        </div>

        {{ $slot }}

        {{-- <div>
            <button class="btn" id="toggleIframe" style="
            position: fixed;
            bottom: 20px;
            right: 20px;
            color: white;
            background-color: blue;
            padding: 8px 10px;
            box-shadow: 5px 2px 5px gray;
            border-radius: 10px;"><i class='bx bxs-palette'></i></button>
            <iframe id="myIframe" src="http://127.0.0.1:8000/guests/42331577-b859-4745-b726-07d107917db6" style="
            position: fixed;
            bottom: 70px;
            right: 20px;
            box-shadow: 3px 3px 6px lightgray ; 
            border: 3px solid darkblue; 
            border-radius: 10px;
            display: none;
            background-color: #fff; 
            box-shadow: 3px 6px 5px gray;"
                width="300" height="500"></iframe>
        </div> --}}

    </div>


    <script>
        //  initializeEmbed();
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
    </script>

    {{-- <script type='text/javascript' charset='utf-8'>     
        var iframe = document.createElement('iframe');       
        document.body.appendChild(iframe);
     
        iframe.src = 'http://127.0.0.1:8000/guests/42331577-b859-4745-b726-07d107917db6';       
        iframe.width = '400';
        iframe.height = '500';
     </script> --}}



    @livewireScripts

</body>



</html>
