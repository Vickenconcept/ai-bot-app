<x-guest-layout>
    {{-- <div>
        <livewire:message-view  :body="$body" :conversationTitle="$conversationTitle"/>
    </div> --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="">
        <div class=" ">
            <nav class="relative flex w-full flex-wrap items-center justify-between bg-blue-900 text-white lg:py-4">
                <div class="flex w-full flex-wrap items-center justify-between px-3">
                    <div class="container ml-36 ">
                        <a class="text-sm text-neutral-800 dark:text-neutral-200" href="#">Hello, Ask me
                            anything</a>
                    </div>
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
