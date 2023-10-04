<!DOCTYPE html>
<html lang="en" class="h-full bg-white">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <meta name="csrf_token" content="TOKEN" id="csrf_token" data-turbolinks-permanent> --}}
    
    <title>ChatBot</title>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Apply CSS styles to the iframe */
        iframe {
            /* float: right;
            margin-left: 10px;  */
            position: fixed;
            bottom: 70px;
            right: 20px;
            box-shadow: 3px 3px 6px lightgray;
            border: 3px solid darkblue;
            border-radius: 10px;
            display: none;
            background-color: #fff;
            box-shadow: 3px 6px 5px gray;
        }

        .btn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            color: white;
            background-color: blue;
            padding: 8px 10px;
            box-shadow: 5px 2px 5px gray;
            border-radius: 10px;
            display: none;
        }

        body.top-window .btn {
            display: block;
            /* Show the toggle button if it is the top window */
        }
    </style>
</head>

<body class="h-full">
    {{ $slot }}




    <script>
        initializeEmbed();
    </script>
</body>

</html>
