<x-app-layout>
    <x-notification />

    <div class="text-gray-700 p-4 md:p-8 space-y-5 bg-gray-50 min-h-screen">
        <div>
            <h1 class="uppercase font-extrabold tracking-widest text-2xl text-gray-200 ">{{ $singleBot->name }}
            </h1>
            <h1 class="font-bold">Share Link</h1>
            <p>When this link is enabled, you can have anyone use this bot by visiting this link.</p>
        </div>
        <a href="{{ route('bots.index') }}" class="z-50" style="z-index: 1000">
            <button class="fixed right-3 md:right-10 top-20 shadow rounded-lg px-3 py-2 bg-purple-700 text-gray-50 ">
                <i class='bx bx-x text-2xl font-semibold '></i>
            </button>
        </a>
        <div class="grid grid-cols-1 md:grid-cols-3">
            <div class="flex flex-wrap    items-center col-span-1 md:col-span-2">
                <div class=" bg-gray-800 text-gray-50 rounded-tl rounded-bl">
                    <p id="{{ $guestChat->id }}"
                        class="w-full  p-2  text-sm font-semibold shadow-inner {{ $guestChat->enabled === 1 ? '' : 'blur-sm' }}  ">
                        {{ route('get_one_guest', ['uuid' => $guestChat->uuid]) }}</p>
                </div>
                <div class="">
                    <button onclick="toCopy(document.getElementById('{{ $guestChat->id }}'))"
                        class=" bg-purple-800 px-4 py-2 text-white  rounded-tr rounded-br text-sm font-semibold   shadow-sm hover:shadow-md  "
                        {{ $guestChat->enabled === 1 ? '' : 'disabled' }}>Copy
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

        <livewire:select-language :guestChat="$guestChat" />
        <hr>

        <section>
            <livewire:select-template :guestChat="$guestChat" />
        </section>

        <hr>
        <section class=" pt-10 space-y-5 " id="here">
            <h1 class="tracking-wider font-bold text-xl ">Embed</h1>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="shadow hover:shadow-lg bg-white  p-4 md:p-10 rounded-lg ">
                    <h3>To get the widget to appear on your webpage simply copy and paste the snippet below somewhere in
                        the body tag.</h3>
                    <div class="text-xs ">
                        <div class=" text-right">
                            <button onclick="toCopy(document.getElementById('para3'))"
                                class="  px-4 py-2 text-purple-600  text-md font-semibold  hover:text-purple-800 "
                                {{ $guestChat->enabled === 1 ? '' : 'disabled' }}>copy <i
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
                    <h3>To get the widget to appear on your web app simply copy and paste the snippet below in your code
                        base</h3>


                    <div class="text-xs">
                        <h3 class="italic text-sm ">Paste in the head tag</h3>
                        <div class=" text-right">
                            <button onclick="toCopy(document.getElementById('para4'))"
                                class="  px-4 py-2 text-purple-600  text-md font-semibold  hover:text-purple-800 "
                                {{ $guestChat->enabled === 1 ? '' : 'disabled' }}>copy <i
                                    class='bx bxs-copy-alt'></i></button>
                        </div>
                        <p id="para4"
                            class="bg-gray-800 text-gray-50 p-5 rounded shadow-inner {{ $guestChat->enabled === 1 ? '' : 'blur-sm' }}">
                            &lt;link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'&gt;
                          
                        </p>
                    </div>




                    <div class="text-xs">
                        <h3 class="italic text-sm ">Paste in your body tag</h3>
                        <div class=" text-right">
                            <button onclick="toCopy(document.getElementById('para1'))"
                                class="  px-4 py-2 text-purple-600  text-md font-semibold  hover:text-purple-800 "
                                {{ $guestChat->enabled === 1 ? '' : 'disabled' }}>copy <i
                                    class='bx bxs-copy-alt'></i></button>
                        </div>
                        <p id="para1"
                            class="bg-gray-800 text-gray-50 p-5 rounded shadow-inner {{ $guestChat->enabled === 1 ? '' : 'blur-sm' }}">

                            &lt;div&gt;<br>
                            &lt;button class="btn" id="toggleIframe"<br>
                            style="<br>
                            position: fixed;<br>
                            bottom: 20px;<br>
                            right: 20px;<br>
                            color: white; border: 0px; cursor: pointer;<br>
                            background-color: {{ $guestChat->launcher_color }} ;<br>
                            padding: 15px 20px;<br>
                            box-shadow: 5px 2px 5px #ccc;<br>
                            border-radius: 50px;"&gt;<br>
                            &lt;i class='bx bx-bot'&gt;&lt;/i&gt;<br>
                            &lt;/button&gt;<br>
                            <br>
                            &lt;div class="" id="myIframe"
                            style="position: fixed; bottom: 70px; right: 20px; display: none; align-items: center; border-radius: 10px;"&gt;<br>
                            &lt;div style="flex: 1;"&gt;<br>
                            &lt;video id="myVideo" autoplay loop muted style="max-width: 100%; height: auto;"&gt;<br>
                            &lt;source
                            src="@if ($guestChat->avatar)
{{ $guestChat->avatar['image_url'] }}
@endif"
                            type="video/mp4"&gt;<br>
                            &lt;/video&gt;<br>
                            &lt;/div&gt;<br>
                            &lt;iframe id="myInnerIframe"
                            src="{{ route('guests.show', ['guest' => $guestChat->uuid]) }}"
                            style="box-shadow: 3px 3px 6px lightgray; border: 3px solid darkpurple; border-radius: 10px; flex: 1;"
                            height="400"&gt;&lt;/iframe&gt;<br>
                            &lt;/div&gt;<br>
                            &lt;/div&gt;<br>

                        </p>
                        <br>
                        <h3 class="italic text-sm ">Paste before the end of your body tag</h3>
                        <div class=" text-right">
                            <button onclick="toCopy(document.getElementById('para2'))"
                                class="  px-4 py-2 text-purple-600  text-md font-semibold  hover:text-purple-800 "
                                {{ $guestChat->enabled === 1 ? '' : 'disabled' }}>copy <i
                                    class='bx bxs-copy-alt'></i></button>
                        </div>
                        <p id="para2"
                            class="bg-gray-800 text-gray-50 p-5 rounded shadow-inner {{ $guestChat->enabled === 1 ? '' : 'blur-sm' }}">

                            &lt;script&gt;<br>
                            const body = document.querySelector('body');<br>
                            body.classList.add('top-window');<br>
                            const btns = document.querySelectorAll('.btn');<br>
                            btns.forEach(btn => {<br>
                            btn.style.display = 'block';<br>
                            });<br>
                            <br>
                            <br>
                            function initializeEmbed() {<br>
                            const container = document.getElementById('myIframe');<br>
                            const toggleIcon = document.getElementById('toggleIframe');<br>
                            <br>
                            toggleIcon.addEventListener('click', () => {<br>
                            container.style.display = (container.style.display === 'none' || container.style.display
                            === '') ?<br>
                            'flex' :<br>
                            'none';<br>
                            });<br>
                            <br>
                            if (window === window.top) {<br>
                            document.body.classList.add('top-window');<br>
                            }<br>
                            }<br>
                            <br>
                            <br>
                            initializeEmbed();<br>
                            &lt;/script&gt;<br>

                        </p>
                    </div>


                </div>

            </div>
        </section>
        <section>
            {{-- <livewire:customize-view :guestChat="$guestChat"/> --}}
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

        // jQuery.noConflict();
        // (function($) {

        // })(jQuery);

        jQuery(document).ready(function($) {

            function updateDiv() {
                $("#here").load(window.location.href + " #here");
            }

            setInterval(() => {
                updateDiv()

            }, 2000);

        });
    </script>
</x-app-layout>
