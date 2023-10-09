<x-app-layout>
    {{-- {{ $singleBot }} --}}
    {{-- {{ $guestChat }} --}}
    <x-notification />

    <div class="text-gray-700 p-4 md:p-8 space-y-5 bg-gray-50 min-h-screen">
        <div>
            <h1 class="uppercase font-extrabold tracking-widest text-2xl text-gray-200 ">{{ $singleBot->name }}
            </h1>
            <h1 class="font-bold">Share Link</h1>
            <p>When this link is enabled, you can have anyone use this bot by visiting this link.</p>
        </div>
        <a href="{{ route('bots.index') }}" class="z-50" style="z-index: 1000">
            <button class="fixed right-3 md:right-10 top-20 shadow rounded-lg px-3 py-2 bg-blue-700 text-gray-50 ">
                <i class='bx bx-x text-2xl font-semibold '></i>
            </button>
        </a>

        <div class="grid grid-cols-1 md:grid-cols-3">
            <div class="flex flex-wrap    items-center col-span-1 md:col-span-2">
                <div class=" bg-gray-800 text-gray-50 rounded-tl rounded-bl">
                    <p id="{{ $guestChat->id }}"
                        class="w-full  p-2  text-sm font-semibold shadow-inner {{ $guestChat->enabled === 1 ? '' : 'blur-sm' }}  ">
                        {{ route('guests.show', ['guest' => $guestChat->uuid]) }}</p>
                </div>
                <div class="">
                    <button onclick="toCopy(document.getElementById('{{ $guestChat->id }}'))"
                        class=" bg-blue-800 px-4 py-2 text-white  rounded-tr rounded-br text-sm font-semibold   shadow-sm hover:shadow-md  " {{ $guestChat->enabled === 1 ? '' : 'disabled' }}>Copy
                        </button>
                </div>
            </div>
        </div>
        <div class="space-y-2">
            <p class="font-semibold">You can disable public share link if you do not wish to share this bot
                publicly.</p>
            <form action="{{ route('guests.update', ['guest' => $guestChat->id]) }}" method="POST">

                @csrf
                @method('PUT')
                <input type="hidden" name="statues" value="0">
                <button
                    class=" bg-red-800 px-6 py-2 text-white rounded-full text-xs font-semibold border-gray-300  shadow-sm hover:shadow-md {{ $guestChat->enabled === 1 ? '' : 'hidden' }}">
                    Disable</button>
            </form>

            <form action="{{ route('guests.update', ['guest' => $guestChat->id]) }}" method="POST">

                @csrf
                @method('PUT')
                <input type="hidden" name="statues" value="1">
                <button
                    class=" bg-green-800 px-6 py-2 text-white rounded-full text-xs font-semibold border-gray-300  shadow-sm hover:shadow-md  {{ $guestChat->enabled === 1 ? 'hidden' : '' }} ">
                    Enable</button>
            </form>
        </div>

        <hr>
        <section class=" pt-10 space-y-5 ">
            <h1 class="tracking-wider font-bold text-xl ">Embed</h1>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="shadow hover:shadow-lg bg-white  p-4 md:p-10 rounded-lg ">
                    <h3>To get the widget to appear on your webpage simply copy and paste the snippet below somewhere in
                        the body tag.</h3>
                    <div class="text-xs ">
                        <div class=" text-right">
                            <button onclick="toCopy(document.getElementById('para3'))"
                                class="  px-4 py-2 text-blue-600  text-md font-semibold  hover:text-blue-800 " {{ $guestChat->enabled === 1 ? '' : 'disabled' }}>copy <i
                                    class='bx bxs-copy-alt'></i></button>
                        </div>
                        <p id="para3"
                            class="w-full  border  border-gray-700 overflow-auto text-left bg-gray-800 text-gray-50 p-5 rounded shadow-inner {{ $guestChat->enabled === 1 ? '' : 'blur-sm' }}"
                            style="visbility:hidden">
                            &lt;iframe src="{{ route('guests.show', ['guest' => $guestChat->uuid]) }}" width="100%"
                            height="400"&gt;
                            &lt;/iframe&gt;
                        </p>
                    </div>
                </div>

                {{--  --}}
                <div class="shadow hover:shadow-lg bg-white  p-4 md:p-10 rounded-lg space-y-5">
                    <h3>To get the widget to appear on your web app simply copy and paste the snippet below in your code base</h3>
                    
                    
                    
                    <div class="text-xs">
                        <h3 class="italic text-sm ">Paste in your body tag</h3>
                        <div class=" text-right">
                            <button onclick="toCopy(document.getElementById('para1'))"
                                class="  px-4 py-2 text-blue-600  text-md font-semibold  hover:text-blue-800 " {{ $guestChat->enabled === 1 ? '' : 'disabled' }}>copy <i
                                    class='bx bxs-copy-alt'></i></button>
                        </div>
                        <p id="para1" class="bg-gray-800 text-gray-50 p-5 rounded shadow-inner {{ $guestChat->enabled === 1 ? '' : 'blur-sm' }}">

                            &lt;div&gt;
                            <br>
                            &lt;button class="btn" id="toggleIframe"
                            style="
                            <br>
                      position: fixed;
                      <br>
                      bottom: 20px;
                      <br>
                      {{ $guestChat->position }}: 20px;
                      <br>
                      color: white;
                      <br>
                      background-color: {{ $guestChat->launcher_color }};
                      <br>
                      padding: {{ $guestChat->launcher_size }};
                      <br>
                      box-shadow: 5px 2px 5px #ccc;
                      <br>
                      border-radius: 50px;"&gt;
                            <br>
                            &lt;i class='bx {{ $guestChat->launcher_icon }}'&gt;&lt;/i&gt;&lt;/button&gt;

                            <br>
                            <br>
                            <br>
                            &lt;iframe id="myIframe"
                            src="{{ route('guests.show', ['guest' => $guestChat->uuid]) }}"
                            <br>
                            style="
                      position: fixed;
                      <br>
                      bottom: 70px;
                      <br>
                      
                      {{ $guestChat->position }}: 20px;
                      <br>
                      box-shadow: 3px 3px 6px lightgray ; 
                      <br>
                      border: 3px solid darkblue; 
                      <br>
                      border-radius: 10px;
                      <br>
                      display: none;
                      <br>
                      background-color: #fff;
                      <br>
                      box-shadow: 3px 6px 5px gray;"
                            <br>
                            width="300" height="500"&gt;&lt;/iframe&gt;
                            <br>
                            &lt;/div&gt;
                        </p>
                        <br>
                        <h3 class="italic text-sm ">Paste before the end of your body tag</h3>
                        <div class=" text-right">
                            <button onclick="toCopy(document.getElementById('para2'))"
                                class="  px-4 py-2 text-blue-600  text-md font-semibold  hover:text-blue-800 " {{ $guestChat->enabled === 1 ? '' : 'disabled' }}>copy <i
                                    class='bx bxs-copy-alt'></i></button>
                        </div>
                        <p id="para2" class="bg-gray-800 text-gray-50 p-5 rounded shadow-inner {{ $guestChat->enabled === 1 ? '' : 'blur-sm' }}">

                            &lt;script&gt;
                            <br>
                            const body = document.querySelector('body');
                            <br>
                            body.classList.add('top-window');
                            <br>

                            const btns = document.querySelectorAll('.btn');
                            <br>
                            btns.forEach(btn => {
                            <br>
                            btn.style.display = 'block';
                            <br>
                            });
                            <br>

                            <br>
                            function initializeEmbed() {
                            <br>
                            const iframe = document.getElementById('myIframe');
                            <br>
                            const toggleIcon = document.getElementById('toggleIframe');
                            <br>
                            <br>
                            toggleIcon.addEventListener('click', () => {
                            <br>
                            iframe.style.display = (iframe.style.display === 'none' || iframe.style.display === '') ?
                            <br>
                            'block' :
                            <br>
                            'none';
                            <br>
                            });
                            <br>
                            <br>

                            if (window === window.top) {
                            <br>
                            document.body.classList.add('top-window');
                            <br>
                            }
                            <br>
                            }
                            <br>
                            <br>
                            initializeEmbed();
                            <br>
                            &lt;/script&gt;
                        </p>
                    </div>


                </div>

            </div>
        </section>
        <section>
            <livewire:customize-view :guestChat="$guestChat"/>
        </section>
    </div>

    <script>
        // for coping text
        function toCopy(copyDiv) {
            var range = document.createRange();
            range.selectNode(copyDiv);
            window.getSelection().removeAllRanges();
            window.getSelection().addRange(range);
            document.execCommand("copy");
            // alert("copied!");
        }
    </script>
</x-app-layout>
