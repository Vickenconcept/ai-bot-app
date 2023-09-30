<x-app-layout>
    <div class="grid grid-cols-1 lg:grid-cols-8 h-full relative" x-data="{ closeSidebar: true, openModal: false, conversation: '',guest:'', isGuest: false }">

        <div class="col-span-2">
            <div class="col-span-2 p-3 bg-blue-900  h-screen fixed  lg:block  lg:w-[315px] space-y-5 {{ request()->routeIs('conversations.show') ? 'hidden' : 'w-full' }}"
                x-show="closeSidebar">

                <hr class="hidden lg:block">

                <div class="space-y-5" x-show="isGuest === false">
                    <div class="grid grid-cols-2">
                        <x-main-button class="bg-gray-50 text-blue-700 shadow-inner"
                            @click="isGuest = false">Yours</x-main-button>
                        <x-main-button class=" text-gray-50 shadow-inner" @click="isGuest = true">Guest</x-main-button>
                    </div>
                    <div class="mt-2 flex space-x-3">
                        <form class=" w-full" action="{{ route('conversations.index') }}" method="GET">
                            <div>
                                <input id="text" name="query" type="text" placeholder="Search conversation"
                                    class="form-control">
                            </div>
                        </form>
                        <form class="" action="{{ route('conversations.store') }}" method="POST">
                            @csrf
                            <button type="submit" class=" bg-gray-100 rounded shadow-sm px-2 py-1"
                                title="Add new conversation"><i class='bx bxs-message-add text-blue-900'></i></button>
                        </form>
                    </div>

                    <ul class="space-y-5" >
                        @foreach ($conversation as $conversation)
                            <li class="text-gray-100  flex justify-between text-md tracking-wide capitalize">
                                <a href="{{ route('conversations.show', $conversation->slug) }}">
                                    <i class='bx bxs-conversation mr-1 text-sm'></i>
                                    {{ $conversation->title }}
                                </a>

                                <x-dropdown>
                                    <x-slot name="trigger">
                                        <button><i
                                                class='bx bx-dots-vertical-rounded hover:bg-gray-50 hover:text-blue-900 transition duration-300 p-2 rounded'></i></button>
                                    </x-slot>
                                    <x-slot name="content">

                                        <x-dropdown-link class="cursor-pointer ">
                                            <div @click=" openModal= true; conversation = @js($conversation) "
                                                class="w-full text-left">Rename <i class='bx bxs-edit-alt'></i></div>

                                        </x-dropdown-link>
                                        <x-dropdown-link>
                                            <form class="w-full"
                                                action="{{ route('conversations.destroy', ['conversation' => $conversation->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="w-full text-left">{{ __('Delete') }} <i
                                                        class='bx bxs-message-rounded-x'></i></button>
                                            </form>
                                        </x-dropdown-link>

                                    </x-slot>
                                </x-dropdown>
                            </li>
                        @endforeach
                    </ul>
                </div>

                {{--  --}}
                <div x-show="isGuest" class="space-y-5" style="display: none;">
                    <div class="grid grid-cols-2">
                        <x-main-button class=" text-gray-50  shadow-inner"
                            @click="isGuest = false">Yours</x-main-button>
                        <x-main-button class="bg-gray-50 text-blue-700 shadow-inner" @click="isGuest = true">Guest</x-main-button>
                    </div>
                    <div class="mt-2 flex space-x-3">
                        <form class=" w-full" action="{{ route('guests.index') }}" method="GET">
                            <div>
                                <input id="text" name="query" type="text" placeholder="Search conversation"
                                    class="form-control">
                            </div>
                        </form>
                        <form class="" action="{{ route('guests.store') }}" method="POST">
                            @csrf
                            <button type="submit" class=" bg-gray-100 rounded shadow-sm px-2 py-1"
                                title="Add new conversation"><i class='bx bxs-message-add text-blue-900'></i></button>
                        </form>
                    </div>

                    <ul class="space-y-5" >
                        @foreach ($guest as $guest)
                            <li class="text-gray-100  flex justify-between text-md tracking-wide capitalize">
                                <a href="{{ route('guests.show', $guest->slug ) }}">
                                    <i class='bx bxs-conversation mr-1 text-sm'></i>
                                    {{ $guest->title }}
                                </a>

                                <x-dropdown>
                                    <x-slot name="trigger">
                                        <button><i
                                                class='bx bx-dots-vertical-rounded hover:bg-gray-50 hover:text-blue-900 transition duration-300 p-2 rounded'></i></button>
                                    </x-slot>
                                    <x-slot name="content">

                                        <x-dropdown-link class="cursor-pointer ">
                                            <div @click=" openModal= true; guest = @js($guest) "
                                                class="w-full text-left">Rename <i class='bx bxs-edit-alt'></i></div>

                                        </x-dropdown-link>
                                        <x-dropdown-link>
                                            <form class="w-full"
                                                action="{{ route('guests.destroy', ['guest' => $guest->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="w-full text-left">{{ __('Delete') }} <i
                                                        class='bx bxs-message-rounded-x'></i></button>
                                            </form>
                                        </x-dropdown-link>

                                    </x-slot>
                                </x-dropdown>
                            </li>
                        @endforeach
                    </ul>
                    <li>this is the guest</li>
                </div>
                {{--  --}}

            </div>
            {{-- modal --}}
            <div class="fixed items-center justify-center  flex top-0 left-0 mx-auto w-full h-full bg-gray-600 bg-opacity-20 z-10 transition duration-1000 ease-in-out"
                x-show="openModal" style="display: none;">
                <div @click.away="openModal = false"
                    class="bg-white w-[70%] lg:w-[40%] shadow-inner  border rounded-lg overflow-auto  pb-6 px-5 transition-all relative duration-700">
                    <div class="space-y-5 pt-5 ">
                        <span class="text-xl font-bold">Rename Conversation</span>
                        <form action="{{ route('updateConversation') }}" method="POST">
                            @csrf
                            {{-- @method('PUT') --}}
                            <div class="space-y-5">
                                <input type="hidden" :value="conversation.id" name="conversationId">
                                <input id="conversation.id" type="text" name="title"
                                    placeholder="Search conversation" :value="conversation.title" class="form-control"
                                    autocomplete="false">
                                <div class="space-x-3">
                                    <x-main-button type="submit" class="text-gray-50">Update</x-main-button>
                                    <x-main-button class="bg-gray-50 text-blue-700 shadow-inner border"
                                        @click="openModal = false">Cancle</x-main-button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-span-6 h-full">

            <div
                class=" w-full h-[500px] flex justify-center items-center {{ request()->routeIs('conversations.index') ? '' : 'hidden' }}">
                <div class="flex justify-between text-blue-600 ">
                    <span class="animate-ping  font-extrabold text-xl mr-2 hidden lg:block"><i
                            class='bx bx-arrow-back'></i></span>
                    <h1 class="text-2xl  font-bold tracking-wider "> Start a conversation</h1>

                </div>
            </div>
            @yield('content')
        </div>
    </div>
</x-app-layout>
