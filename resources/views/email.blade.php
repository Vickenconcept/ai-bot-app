<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>email</title>
</head>
<body>
    <section class="max-w-2xl px-6 py-8 mx-auto bg-white dark:bg-gray-900">
        <header>
            <a href="/">
                {{-- <img class="w-auto h-7 sm:h-8" src="https://merakiui.com/images/full-logo.svg" alt=""> --}}
            </a>
        </header>
    
        <main class="mt-8">
            <h2 class="text-gray-700 dark:text-gray-200">Hi </h2>
    
            <p class="mt-2 leading-loose text-gray-600 dark:text-gray-300 ">
                {{ $data['name'] }} has invited you to join the team  <span class="font-semibold ">.</span>.
            </p>
            
            <a href="{{ $data['access'] }}">
                <button class="px-6 py-2 mt-4 text-sm font-medium tracking-wider text-white capitalize transition-colors duration-300 transform bg-blue-600 rounded-lg hover:bg-blue-500 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-80">
                    Accept the invite
                </button>
            </a>
            
            <p class="mt-8 text-gray-600 dark:text-gray-300">
                Thanks <br>
            </p>
        </main>
        
    
        <footer class="mt-8">
            <p class="text-gray-500 dark:text-gray-400">
                This email was sent to <a href="#" class="text-blue-600 hover:underline dark:text-blue-400" target="_blank">{{ $data['email'] }}</a>. 
            </p>
    
            <p class="mt-3 text-gray-500 dark:text-gray-400">© {{ now() }}  Botconvert. All Rights Reserved.</p>
        </footer>
    </section>
    
</body>
</html>