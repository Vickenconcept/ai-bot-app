<x-app-layout>
    {{-- <x-notification /> --}}
    <div class="grid grid-cols-1 lg:grid-cols-8 h-full relative" x-data="{ closeSidebar: true, openModal: false, openModal2: false, conversation: '', guest: '', isGuest: false }">

        <div class="col-span-2">
            <div class="col-span-2 p-3 bg-purple-200  h-screen fixed  lg:block  lg:w-[315px] space-y-5 {{ request()->routeIs('conversations.show') ? 'hidden' : 'w-full' }}"
                x-show="closeSidebar">

                <hr class="hidden lg:block">

                <div class="space-y-1" x-show="isGuest === false">
                    <div class="flex ">
                        <button class="border-b-2 border-white py-1 px-4 font-semibold  text-sm  text-purple-700"
                            @click="isGuest = false">Yours</button>
                        <x-main-button class=" text-gray-50 shadow-inner border-b-2  border-white"
                            @click="isGuest = true">Guest</x-main-button>
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
                                title="Add new conversation"><i class='bx bxs-message-add text-purple-900'></i></button>
                        </form>
                    </div>

                    <ul class="space-y-5 pt-5">
                        @foreach ($conversation as $conversation)
                            <li
                                class="text-purple-900 font-semibold  flex justify-between text-md tracking-wide capitalize">
                                <a href="{{ route('conversations.show', $conversation->slug) }}">
                                    <i class='bx bxs-conversation mr-1 text-sm'></i>
                                    {{ $conversation->title }}
                                </a>

                                <x-dropdown>
                                    <x-slot name="trigger">
                                        <button><i
                                                class='bx bx-dots-vertical-rounded hover:bg-gray-50 hover:text-purple-900 transition duration-300 p-2 rounded'></i></button>
                                    </x-slot>
                                    <x-slot name="content">

                                        <x-dropdown-link class="cursor-pointer ">
                                            <button @click=" openModal= true; conversation = @js($conversation) "
                                                class="w-full text-left px-4 py-2">Rename <i class='bx bxs-edit-alt'></i></button>

                                        </x-dropdown-link>
                                        <x-dropdown-link>
                                            <form class="w-full"
                                                action="{{ route('conversations.destroy', ['conversation' => $conversation->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="w-full text-left px-4 py-2">{{ __('Delete') }} <i
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
                <div x-show="isGuest" class="space-y-1" style="display: none;">
                    <div class="flex">
                        <x-main-button class=" text-gray-50  shadow-inner border-b-2  border-white"
                            @click="isGuest = false">Yours</x-main-button>
                        <button class="border-b-2 border-white py-1 px-4 font-semibold  text-sm "
                            @click="isGuest = true">Guest</button>
                    </div>
                    <div class="mt-2 flex space-x-3">
                        <form class=" w-full" action="{{ route('conversations.index') }}" method="GET">
                            <div>
                                <input id="text" name="query" type="text" placeholder="Search conversation"
                                    class="form-control">
                            </div>
                        </form>
                        <form class="" action="{{ route('guests.store') }}" method="POST">
                            @csrf
                            <button type="submit" class=" bg-gray-100 rounded shadow-sm px-2 py-1"
                                title="Add new conversation"><i class='bx bxs-message-add text-purple-900'></i></button>
                        </form>
                    </div>

                    <ul class="space-y-5 pt-5">
                        @foreach ($guest as $guest)
                            <li
                                class="text-purple-900 font-semibold  flex justify-between text-md tracking-wide capitalize">
                                <a href="{{ route('guests.show', $guest->uuid) }}">
                                    <i class='bx bxs-conversation mr-1 text-sm'></i>
                                    {{ $guest->title }}
                                </a>

                                <x-dropdown>
                                    <x-slot name="trigger">
                                        <button><i
                                                class='bx bx-dots-vertical-rounded hover:bg-gray-50 hover:text-purple-900 transition duration-300 p-2 rounded'></i></button>
                                    </x-slot>
                                    <x-slot name="content">

                                        <x-dropdown-link class="cursor-pointer">
                                            <button @click=" openModal2= true; guest = @js($guest) "
                                                class="w-full text-left px-4 py-2">Rename <i class='bx bxs-edit-alt'></i></button>

                                        </x-dropdown-link>
                                        <x-dropdown-link>
                                            <form class="w-full"
                                                action="{{ route('guests.destroy', ['guest' => $guest->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="w-full text-left px-4 py-2">{{ __('Delete') }}
                                                    <i class='bx bxs-message-rounded-x'></i></button>
                                            </form>
                                        </x-dropdown-link>

                                    </x-slot>
                                </x-dropdown>
                            </li>
                        @endforeach
                    </ul>
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
                                    <button
                                        class="bg-gray-50 rounded hover:shadow-md px-2 py-1 text-purple-700 shadow-inner border"
                                        @click="openModal = false">Cancle</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

            {{-- modal for guest --}}
            <div class="fixed items-center justify-center  flex top-0 left-0 mx-auto w-full h-full bg-gray-600 bg-opacity-20 z-10 transition duration-1000 ease-in-out"
                x-show="openModal2" style="display: none;">
                <div @click.away="openModal2 = false"
                    class="bg-white w-[70%] lg:w-[40%] shadow-inner  border rounded-lg overflow-auto  pb-6 px-5 transition-all relative duration-700">
                    <div class="space-y-5 pt-5 ">
                        <span class="text-xl font-bold">Rename Conversation</span>
                        <form action="{{ route('updateConversation') }}" method="POST">
                            @csrf
                            {{-- @method('PUT') --}}
                            <div class="space-y-5">
                                <input type="hidden" :value="guest.id" name="conversationId">
                                <input id="guest.id" type="text" name="title" placeholder="Search guest"
                                    :value="guest.title" class="form-control" autocomplete="false">
                                <div class="space-x-3">
                                    <x-main-button type="submit" class="text-gray-50">Update</x-main-button>
                                    <button
                                        class="bg-gray-50 rounded hover:shadow-md px-2 py-1 text-purple-700 shadow-inner border"
                                        @click="openModal2 = false">Cancle</button>
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
                <div class="flex justify-between text-purple-600 ">
                    <span class="animate-ping  font-extrabold text-xl mr-2 hidden lg:block"><i
                            class='bx bx-arrow-back'></i></span>
                    <h1 class="text-2xl  font-bold tracking-wider "> Start a conversation </h1>

                </div>
            </div>
            @yield('content')
        </div>
    </div>
</x-app-layout>
