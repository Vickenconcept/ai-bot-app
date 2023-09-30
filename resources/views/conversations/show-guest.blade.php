<x-guest-layout>
    {{-- <div>
        <livewire:message-view  :body="$body" :conversationTitle="$conversationTitle"/>
    </div> --}}
    <div class=" text-gray-700 pb-20">
        {{-- @auth
        <x-header/>
            
        @endauth --}}
        <div class="sticky top-16 py-2 bg-gray-100 shadow lg:hidden p-5"><a href="{{ route('conversations.index') }}"
                class=" font-bold tracking-wider text-xl"> <i class='bx bxs-chevron-left'></i>
                {{ $conversationTitle->title }} </a></div>
        <livewire:message-view :body="$body" :conversationTitle="$conversationTitle" />
        {{-- <div class="h-20">
    
        </div> --}}
    </div>
</x-guest-layout>
