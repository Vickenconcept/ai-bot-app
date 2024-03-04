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



    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    <link rel="stylesheet" href="{{ asset('build/assets/app-a461d729.css') }}">
    <link rel="stylesheet" href="{{ asset('build/assets/app-1105f430.css') }}">


    @livewireStyles
</head>

<body class="h-full">
    <div id="ap" class="min-h-screen bg-purple-50 text-gray-700" x-data="{ openHelp: false }">

        <x-header />
        <x-pre-loader />
        {{ $slot }}
        <iframe id="myIframe" src="https://trust.test/campaign/component/dc27f900-1f45-4651-b253-068df22240be"
            style=" position: relative;" width="100%" height="600"></iframe>
    </div>

    <script>
        function logout(e) {
            localStorage.clear();
            e.closest('form').submit();
        }
    </script>


    @livewireScripts
    <script src="{{ asset('build/assets/app-11155cd2.js') }}"></script>

</body>

</html>
