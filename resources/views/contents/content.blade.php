<x-app-layout>
    <div class=" h-full relative w-full lg:w-[80%] mx-auto px-10" x-data="{ closeSidebar: true, openModal: false, content: '' }">
        <div class="flex justify-between items-center py-4">
            <div class=" w-full md:w-1/2 space-y-2">
                <h1 class="font-bold text-2xl tracking-wider">Content Folder</h1>
                <p>Search and create knowledge for your next project</p>

            </div>
            <div class="flex space-x-3 w-full  md:w-1/2 ">
                <form class=" w-1/2" action="{{ route('contents.index') }}" method="GET">
                    <div>
                        <input id="text" name="query" type="text" placeholder="Search content"
                            class="form-control bg-purple-100">
                    </div>
                </form>
                <form class="w-1/2" action="{{ route('contents.store') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class=" w-full whitespace-nowrap text-purple-50 bg-gradient-to-r from-violet-500 to-fuchsia-500  rounded shadow-sm px-2 pt-1 pb-2"
                        title="Add new content"><i class='bx bxs-folder text-purple-100'></i> Add content
                        folder</button>
                </form>

            </div>
        </div>

        <section class="rounded-md border shadow  p-3 space-y-3">
            <h2 class="font-bold">Folders</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
                @foreach ($contents as $content)
                    <div class="bg-purple-200 hover:bg-purple-300 border rounded-md p-3 space-y-10">
                        <p class="font-semibold capitalize">
                            <a href="{{ route('contents.show', $content) }}">
                                <i class='bx bxs-folder mr-1 text-purple-600'></i>{{ $content->title }}
                            </a>
                            <span class="text-xs bg-purple-300 text-purple-950 px-1 ml-5 rounded-full"> {{ $content->documents->count() }}</span>
                        </p>
                        <div class="flex justify-between items-center">
                            <p class="text-xs text-gray-700 "><i class='bx bx-calendar'></i> {{ $content->created_at }}
                            </p>
                            <x-dropdown>
                                <x-slot name="trigger">
                                    <button><i
                                            class='bx bx-dots-vertical-rounded hover:bg-purple-50 hover:text-purple-900 transition duration-300 p-2 rounded'></i></button>
                                </x-slot>
                                <x-slot name="content">

                                    <x-dropdown-link class="cursor-pointer ">
                                        <div @click=" openModal= true; content = @js($content) "
                                            class="w-full text-left px-4 py-2">Rename <i class='bx bxs-edit-alt'></i>
                                        </div>

                                    </x-dropdown-link>
                                    <x-dropdown-link>
                                        <form class="w-full"
                                            action="{{ route('contents.destroy', ['content' => $content->id]) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="w-full text-left px-4 py-2">{{ __('Delete') }} <i
                                                    class='bx bxs-message-rounded-x'></i></button>
                                        </form>
                                    </x-dropdown-link>

                                </x-slot>
                            </x-dropdown>

                        </div>
                    </div>
                @endforeach
            </div>

        </section>




        <div class="">
            {{-- modal --}}
            <div class="fixed items-center justify-center  flex top-0 left-0 mx-auto w-full h-full bg-gray-600 bg-opacity-20 z-10 transition duration-1000 ease-in-out"
                x-show="openModal" style="display: none;">
                <div @click.away="openModal = false"
                    class="bg-purple-100 w-[70%] lg:w-[40%] shadow-inner  border rounded-lg overflow-auto  pb-6 px-5 transition-all relative duration-700">
                    <div class="space-y-5 pt-5 ">
                        <span class="text-xl font-bold">Rename Content</span>

                        <form action="{{ route('updateName') }} " method="POST">
                            @csrf
                            {{-- @method('PUT') --}}
                            <div class="space-y-5">
                                <input type="hidden" :value="content.id" name="contentId">
                                <input id="content.id" type="text" name="title" placeholder="Search content"
                                    :value="content.title" class="form-control" autocomplete="false">
                                <div class="space-x-3">
                                    <x-main-button type="submit" class="text-gray-50">Update</x-main-button>
                                    <button
                                        class="bg-gray-50 px-2 py-1 rounded hover:shadow text-purple-700 shadow-inner border"
                                        @click="openModal = false">Cancle</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="col-span-6 h-full">
            <div
            class=" w-full h-[500px] flex justify-center items-center {{ request()->routeIs('contents.index') ? '' : 'hidden' }}">
            <div class="flex justify-between text-purple-600 ">
                <span class="animate-ping  font-extrabold text-xl mr-2 hidden lg:block"><i class='bx bx-arrow-back'></i></span>
                <h1 class="text-2xl  font-bold tracking-wider "> Select a folder</h1>

            </div>
        </div>
        @yield('content')
        </div> --}}

    </div>

</x-app-layout>
