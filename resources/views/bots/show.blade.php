<x-app-layout>
    {{-- {{ $singleBot }} --}}
    {{-- {{ $guestChat }} --}}
    <x-notification />

    <div class="text-gray-700 p-8 space-y-5 bg-gray-50 min-h-screen">
        <div>
            <h1 class="uppercase font-extrabold tracking-widest text-2xl text-gray-500 underline">{{ $singleBot->name }}</h1>
            <h1 class="font-bold">Share Link</h1>
            <p>When this link is enabled, you can have anyone use this bot by visiting this link.</p>
        </div>
        <a href="{{ route('bots.index') }}">
           <button class="fixed right-10 top-20 shadow rounded-lg px-3 py-2 bg-blue-700 text-gray-50 ">
            <i class='bx bx-x text-2xl font-semibold'></i>
           </button>
        </a>

                <div class="grid grid-cols-3">
                    <div class="flex  items-center col-span-2">
                        <div class="">
                            <p id="{{ $guestChat->id }}"
                                class="w-full  p-2 border text-sm font-semibold shadow-inner border-gray-300 bg-white ">
                                {{ route('guests.show', ['guest' => $guestChat->uuid]) }}</p>
                        </div>
                        <div class="">
                            <button onclick="toCopy(document.getElementById('{{ $guestChat->id }}'))"
                                class=" bg-blue-800 px-4 py-2 text-white border text-sm font-semibold border-gray-300  shadow-sm hover:shadow-md ">Copy
                                Clipboard</button>
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

                <section class="">
                    <h1 class="tracking-wider font-bold text-xl">Embed</h1>
                    <div class="grid grid-cols-2 gap-8">
                        <div class="shadow hover:shadow-lg bg-white  p-10 rounded-lg">
                            <h3>To get the widget to appear on your webpage simply copy and paste the snippet below somewhere in the body tag.</h3>
                            <xmp id="{{ $guestChat->id }}"
                                class="w-full rounded-lg border text-sm border-gray-700 mt-5 overflow-auto text-left"
                                style="visbility:hidden">
                                <iframe src="{{ route('guests.show', ['guest' => $guestChat->uuid]) }}" width="600"
                                    height="400">
                                </iframe>
                            </xmp>
                          
                        </div>
                        <div class="shadow hover:shadow-lg bg-white  p-10 rounded-lg">
                           
                        </div>

                    </div>
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
