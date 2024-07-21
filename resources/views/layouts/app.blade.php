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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js "></script>

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/core/main.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid/main.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/timegrid/main.css" rel="stylesheet" />



    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    <link rel="stylesheet" href="{{ asset('build/assets/app-a461d729.css') }}">
    <link rel="stylesheet" href="{{ asset('build/assets/app-18e95c7c.css') }}">


    @livewireStyles
</head>

<body class="h-full">
    <div id="ap" class="min-h-screen bg-purple-50 text-gray-700" x-data="{ openHelp: false }">

        <x-header />
        <x-pre-loader />
        {{ $slot }}

        <div>
            <button class="btn" id="toggleIframe"
                style="
            position: fixed;
            bottom: 20px;
            right: 20px;
            color: white; border: 0px; cursor: pointer;
            background-color: #1d98f7;
            padding: 15px 20px;
            box-shadow: 5px 2px 5px #ccc;
            border-radius: 50px;">
                <i class='bx bx-bot'></i>
            </button>

            <div class="" id="myIframe"
                style="position: fixed; bottom: 70px; right: 20px; display: none; align-items: center; border-radius: 10px;">
                <div style="flex: 1;">
                    <video id="myVideo" autoplay loop muted style="max-width: 100%; height: auto;">
                        <source src="https://avatarcrewapp.com/video/preview (1).mp4 " type="video/mp4">
                    </video>
                </div>
                <iframe id="myInnerIframe" src="https://avatarcrewapp.com/guests/c5b18c84-14c6-4e4f-9968-c6a35f2a813f"
                    style="box-shadow: 3px 3px 6px lightgray; border: 3px solid darkpurple; border-radius: 10px; flex: 1;"
                    height="400"></iframe>
            </div>
        </div>




        <script>
            const body = document.querySelector('body');
            body.classList.add('top-window');
            const btns = document.querySelectorAll('.btn');
            btns.forEach(btn => {
                btn.style.display = 'block';
            });


            function initializeEmbed() {
                const container = document.getElementById('myIframe');
                const toggleIcon = document.getElementById('toggleIframe');

                toggleIcon.addEventListener('click', () => {
                    container.style.display = (container.style.display === 'none' || container.style.display === '') ?
                        'flex' :
                        'none';
                });

                if (window === window.top) {
                    document.body.classList.add('top-window');
                }
            }


            initializeEmbed();
        </script>

        <script>
            // window.addEventListener('DOMContentLoaded', () => {
            //     test()
            // })
        </script>


        {{-- <script>
    const body = document.querySelector('body');
    body.classList.add('top-window');
    const btns = document.querySelectorAll('.btn');
    btns.forEach(btn => {
        btn.style.display = 'block';
    });

    function initializeEmbed() {
        const container = document.getElementById('myIframe');
        const toggleIcon = document.getElementById('toggleIframe');

        toggleIcon.addEventListener('click', () => {
            container.style.display = (container.style.display === 'none' || container.style.display === '') ?
                'flex' :
                'none';
        });

        if (window === window.top) {
            document.body.classList.add('top-window');
        }
    }

    initializeEmbed();
</script> --}}

        <script>
            function logout(e) {
                localStorage.clear();
                e.closest('form').submit();
            }
        </script>


<script src="{{ asset('build/assets/app-11155cd2.js') }}"></script>
@livewireScripts

</body>

</html>
