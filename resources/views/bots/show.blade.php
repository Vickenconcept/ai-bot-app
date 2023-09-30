<x-app-layout>
    {{-- {{ $singleBot }} --}}
    {{-- {{ $guestChat }} --}}


    <div class="text-gray-700 p-8 space-y-7 bg-gray-50 min-h-screen">
       <div>
        <h1 class="font-bold">Share Link</h1>
        <p>When this link is enabled, you can have anyone use this bot by visiting this link.</p>
       </div>
       <a href="{{ route('bots.index') }}">< back</a>
     
        <div class="grid grid-cols-3">
            <div class="flex  items-center col-span-2">
                <div class="">
                    <p id="{{ $guestChat->id }}" class="w-full  p-2 border text-sm font-semibold shadow-inner border-gray-300 bg-white ">
                        {{ route('guests.show', ['guest' => $guestChat->uuid]) }}</p>
                </div>
                <div class="">
                    <button onclick="toCopy(document.getElementById('{{ $guestChat->id }}'))"
                        class=" bg-blue-800 px-4 py-2 text-white border text-sm font-semibold border-gray-300  shadow-sm hover:shadow-md ">Copy
                        Clipboard</button>
                </div>
            </div>
        </div>
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
