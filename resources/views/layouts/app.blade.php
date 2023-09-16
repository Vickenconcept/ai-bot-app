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


    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}


    @livewireStyles
    @livewireScripts
    @vite(['resources/css/app.css', 'resources/js/app.js'])



</head>

<body class="h-full">
    <div id="ap" class="min-h-screen bg-gray- text-gray-700">

        <x-header />

        {{ $slot }}

    </div>


</body>


<script>
    function logout(e) {
        localStorage.clear();
        e.closest('form').submit();
    }
</script>

</html>