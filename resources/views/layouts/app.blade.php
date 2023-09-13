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

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="h-full">
    <div id="app" class="min-h-screen bg-gray- text-gray-700">
        {{-- <div class=" px-10 py-5 ">

            <form action="{{ route('auth.logout') }}" method="POST">
                @csrf

                <a href="javascript:void(0)" onclick="logout(this)">logout</a>
            </form>c  c   cccv 
        </div> --}}
        <x-header />

        {{ $slot }}

    </div>


    {{-- @vite(['resources/js/frontend.js']) --}}
</body>


<script>
    function logout(e) {
        localStorage.clear();
        e.closest('form').submit();
    }
</script>

</html>
