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

            <div>
                <button class="btn" id="toggleIframe"
                    {{-- style="
          position: fixed;
          bottom: 20px;
          right: 20px;
          color: white;
          background-color: blue;
          padding: 8px 10px;
          box-shadow: 5px 2px 5px gray;
          border-radius: 10px;" --}}
          >
          <i class='bx bxs-palette'></i></button>
          <iframe id="myIframe" 
          src="http://127.0.0.1:8000/guests/42331577-b859-4745-b726-07d107917db6"
          {{-- style="
          position: fixed;
          bottom: 70px;
          right: 20px;
          box-shadow: 3px 3px 6px lightgray ; 
          border: 3px solid darkblue; 
          border-radius: 10px;
          display: none;
          background-color: #fff; 
          box-shadow: 3px 6px 5px gray;" --}}
                    width="300" height="500"></iframe>
            </div>
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
