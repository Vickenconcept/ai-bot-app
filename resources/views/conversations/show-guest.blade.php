<x-guest-layout>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="">
        <x-notification />
        <div class=" ">
            {{-- <nav class="relative flex w-full flex-wrap items-center justify-between bg-blue-900 text-white lg:py-4">
                <div class="flex w-full flex-wrap items-center justify-between px-3">
                    <div class="container ml-36 ">
                        <a class="text-sm text-neutral-800 dark:text-neutral-200" href="#">Hello, Ask me
                            anything</a>
                    </div>
                </div>
            </nav> --}}
            <nav class=" flex px-5 py-3 top-0 w-full shadow"
                style="background-color: {{ $conversationTitle->nav_bg_color }}; color: {{ $conversationTitle->nav_col }}">
                <img class="h-12 w-12  rounded-xl mr-2"
                    src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                    alt="">
                <div class="flex-grow">
                    <ul class="capitalize" style="text-align:  {{ $conversationTitle->layout }}">
                        <li class="font-bold text-xl">{{ $conversationTitle->head_title }}</li>
                        <li>{{ $conversationTitle->head_subtitle }}</li>
                    </ul>
                </div>

            </nav>
        </div>
        <div class=" text-gray-700 pb-20 w-full md:w-[75%] mx-auto ">

            <livewire:message-view :body="$body" :conversationTitle="$conversationTitle" />
            {{-- <div class="h-20">
        
            </div> --}}


        </div>
    </div>
    <script type="text/javascript">
        function initializeEmbed() {
            const iframe = document.getElementById('myIframe');
            const toggleIcon = document.getElementById('toggleIframe');

            toggleIcon.addEventListener('click', () => {
                iframe.style.display = (iframe.style.display === 'none' || iframe.style.display === '') ? 'block' :
                    'none';
            });

            // Add a class to the body if it is the top window
            if (window === window.top) {
                document.body.classList.add('top-window');
            }
        }
    </script>
</x-guest-layout>
