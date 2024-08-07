<x-guest-layout>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="">
        <x-notification />

        @if ($conversationTitle->template === 'temp1')
            <nav class=" fixed flex px-5 py-3 top-0 w-full shadow mb-20 {{ $conversationTitle->nav_bg_color }}bg-purple-900 text-white"
                style="background-color: {{ $conversationTitle->nav_bg_color }}; color: {{ $conversationTitle->nav_col }}">
                    
                    @if ($conversationTitle->logo)
                    <img src="{{ $conversationTitle->logo }}" alt="" class="h-10 w-10 rounded-xl mr-2">
                    @else 
                    <img class="h-10 w-10 rounded-xl mr-2" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                    @endif
                <div class="flex-grow">
                    <ul class="capitalize" style="text-align:  {{ $conversationTitle->layout }}">
                        <li class="font-bold text-xl">{{ $conversationTitle->head_title ?? 'Welcome' }} </li>
                        <li class="text-xs font-semibold">{{ $conversationTitle->head_subtitle ?? 'Ask Me Something' }}</li>
                    </ul>
                </div>

                {{-- @if (auth()->check())
                    <a href="{{ route('conversations.index') }}"
                        class="self-center px-1 hover:border-b border-gray-50 justify-self-center"><i
                            class='bx bxs-chevron-left'></i>Back</a>
                @endif --}}
            </nav>
            <div class=" text-gray-700 pb-20 w-full md:w-[75%] mx-auto mt-12 ">
                <livewire:message-view :body="$body" :conversationTitle="$conversationTitle" />
            </div>
        @elseif ($conversationTitle->template === 'temp2')
            <livewire:template-two :body="$body" :conversationTitle="$conversationTitle" />
        @elseif ($conversationTitle->template === 'temp3')
            <nav class=" fixed flex px-5 py-3 top-0 w-full shadow mb-20 {{ $conversationTitle->nav_bg_color }}bg-purple-900 text-white"
                style="background-color: {{ $conversationTitle->nav_bg_color }}; color: {{ $conversationTitle->nav_col }}">
                <ul class="capitalize" style="text-align:  {{ $conversationTitle->layout }}">
                    <li class="font-bold text-xl">{{ $conversationTitle->head_title ?? 'Welcome' }} </li>

                </ul>
            </nav>
            <livewire:template-three :body="$body" :conversationTitle="$conversationTitle" />
        @elseif ($conversationTitle->template === 'temp4')
            <nav class=" fixed flex px-5 py-3 top-0 w-full shadow mb-20 {{ $conversationTitle->nav_bg_color }}bg-purple-900 text-white"
                style="background-color: {{ $conversationTitle->nav_bg_color }}; color: {{ $conversationTitle->nav_col }}">
                <ul class="capitalize" style="text-align:  {{ $conversationTitle->layout }}">
                    <li class="font-bold text-xl">{{ $conversationTitle->head_title ?? 'Welcome' }} </li>

                </ul>
            </nav>
            <livewire:template-four :body="$body" :conversationTitle="$conversationTitle" />
        @elseif ($conversationTitle->template === 'temp5')
            <nav class=" fixed flex px-5 py-3 top-0 w-full shadow mb-20 {{ $conversationTitle->nav_bg_color }}bg-purple-900 text-white"
                style="background-color: {{ $conversationTitle->nav_bg_color }}; color: {{ $conversationTitle->nav_col }}">
                <ul class="capitalize" style="text-align:  {{ $conversationTitle->layout }}">
                    <li class="font-bold text-xl">{{ $conversationTitle->head_title ?? 'Welcome' }} </li>

                </ul>
            </nav>
            <livewire:template-five :body="$body" :conversationTitle="$conversationTitle" />
        @elseif ($conversationTitle->template === 'temp6')
            <nav class=" fixed flex px-5 py-3 top-0 w-full shadow mb-20 {{ $conversationTitle->nav_bg_color }}bg-purple-900 text-white"
                style="background-color: {{ $conversationTitle->nav_bg_color }}; color: {{ $conversationTitle->nav_col }}">
                <ul class="capitalize" style="text-align:  {{ $conversationTitle->layout }}">
                    <li class="font-bold text-xl">{{ $conversationTitle->head_title ?? 'Welcome' }} </li>

                </ul>
            </nav>
            <livewire:template-six :body="$body" :conversationTitle="$conversationTitle" />
            
        @elseif ($conversationTitle->template === 'temp7')
            <nav class=" fixed flex px-5 py-3 top-0 w-full shadow mb-20 z-50 {{ $conversationTitle->nav_bg_color }}bg-purple-900 text-white"
                style="background-color: {{ $conversationTitle->nav_bg_color }}; color: {{ $conversationTitle->nav_col }}">
                <ul class="capitalize" style="text-align:  {{ $conversationTitle->layout }}">
                    <li class="font-bold text-xl">{{ $conversationTitle->head_title ?? 'Welcome' }} </li>

                </ul>
            </nav>
            <livewire:template-seven :body="$body" :conversationTitle="$conversationTitle" />
        @endif

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
