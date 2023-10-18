<x-app-layout>

    <div class="   m-4 lg:m-10 space-y-5 pb-50 " x-data="{ isOpen: false, bot: '', openModal: false }">
        @if ($errors->any())
            <div class="bg-red-50 text-red-300  p-3 border border-red-300 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="flex justify-end">
            <x-main-button class="text-gray-50 " @click="isOpen = true">+ New Bot</x-main-button>
        </div>
        <div class="relative  shadow-md sm:rounded-lg ">
            <table class="w-full text-sm text-left text-gray-500 ">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50  ">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Bot name
                        </th>
                        <th scope="col" class="px-6 py-3 hidden lg:block">
                            Description
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Model
                        </th>
                        <th scope="col" class="px-6 py-3 hidden lg:block">
                            Created At
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <span class="sr-only">Edit</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bots as $bot)
                        <tr class="bg-white border-b  hover:bg-gray-50 ">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap capitalize">
                                {{ $bot->name }}
                            </th>
                            <td class="px-6 py-4 w-[500px] capitalize line-clamp-1 hidden lg:block">
                                {{ $bot->description }}
                            </td>
                            <td class="px-6 py-4 capitalize">
                                {{ $bot->model }}
                            </td>
                            <td class="px-6 py-4 capitalize hidden lg:block">
                                {{ $bot->created_at }}
                            </td>
                            <td class="px-6 py-4 text-right ">
                                <div class="flex rounded border  divide-x divide-slate-300 bg-purple-600  text-white"
                                    :class="'{{ $bot->name }}'
                                    === 'bot' ? 'hidden' : ''">
                                    <a href="{{ route('bots.show', $bot) }}"
                                        class="font-medium  py-1 px-3 hover:bg-purple-700"><i
                                            class='bx bxs-share-alt mr-1'></i>share</a>

                                    <x-dropdown>
                                        <x-slot name="trigger">
                                            <button><i
                                                    class='bx bx-dots-vertical-rounded  transition duration-300  py-2 px-3'></i></button>
                                        </x-slot>
                                        <x-slot name="content">

                                            <x-dropdown-link class="cursor-pointer ">
                                                <div @click=" openModal= true; bot = @js($bot) "
                                                    class="w-full text-left">Edit <i class='bx bxs-edit-alt'></i></div>

                                            </x-dropdown-link>
                                            <x-dropdown-link class="cursor-pointer "
                                                href="{{ route('conversations.index') }}">
                                                <div class="w-full text-left">Chat <i
                                                        class='bx bx-message-rounded mr-1 text-sm'></i></div>

                                            </x-dropdown-link>
                                          
                                            <x-dropdown-link>
                                                <form class="w-full"
                                                    action="{{ route('bots.destroy', ['bot' => $bot->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="w-full text-left">{{ __('Delete') }}
                                                        <i class='bx bxs-message-rounded-x'></i></button>
                                                </form>
                                            </x-dropdown-link>

                                        </x-slot>
                                    </x-dropdown>
                                </div>

                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        {{-- modal --}}
        <div class="fixed items-center justify-center m-0   overflow-auto flex top-0 left-0 mx-auto w-full h-full bg-gray-600 bg-opacity-20 z-10 transition duration-1000 ease-in-out"
            x-show="isOpen" style="display: none;">
            <div @click.away="isOpen = false"
                class="bg-white w-[90%] lg:w-[70%] h-[500px]  shadow-inner   border rounded-lg overflow-auto  pb-6 px-5 transition-all relative duration-700">
                <div class="space-y-5 pt-5 ">
                    <button @click="isOpen = false"><i class="bx bx-x text-xl font-bold"></i></button>



                    <form action="{{ route('bots.store') }}" method="POST" id="form">
                        @csrf

                        <div class="space-y-5">
                            <h1 class=" font-bold mb-2 underline">Persoanality<span class="text-red-400 ml-1">*</span>
                            </h1>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-2" x-data="{ selected: null }">

                                <input type="radio" name="personality" id="factual" value="In providing factual information, I'll offer accurate and reliable details on various topics, helping you make informed decisions and broaden your knowledge. Let's explore the world of facts and information.
                                " hidden
                                    x-model="selected">
                                <label for="factual"
                                    class="font-semibold capitalize bg-gray-100 border rounded p-2 cursor-pointer "
                                    :class="{
                                        'bg-purple-100 border border-purple-300': selected === 'factual',
                                        '': selected !==
                                            'factual'
                                    }">factual</label>

                                <input type="radio" name="personality" id="hr" value="hr" hidden
                                    x-model="selected">
                                <label for="hr"
                                    class="font-semibold upperase bg-gray-100 border rounded p-2 cursor-pointer"
                                    :class="{ 'bg-purple-100 border border-purple-300': selected === 'hr', '': selected !== 'hr' }">HR</label>

                                <input type="radio" name="personality" id="creative" value="creative" hidden
                                    x-model="selected">
                                <label for="creative"
                                    class="font-semibold capitalize bg-gray-100 border rounded p-2 cursor-pointer"
                                    :class="{
                                        'bg-purple-100 border border-purple-300': selected === 'creative',
                                        '': selected !==
                                            'creative'
                                    }">Creative</label>

                                <input type="radio" name="personality" id="tranning" value="tranning" hidden
                                    x-model="selected">
                                <label for="tranning"
                                    class="font-semibold capitalize bg-gray-100 border rounded p-2 cursor-pointer"
                                    :class="{
                                        'bg-purple-100 border border-purple-300': selected === 'tranning',
                                        '': selected !==
                                            'tranning'
                                    }">Tranning</label>

                                <input type="radio" name="personality" id="itSupport" value="itSupport" hidden
                                    x-model="selected">
                                <label for="itSupport"
                                    class="font-semibold capitalize bg-gray-100 border rounded p-2 cursor-pointer"
                                    :class="{
                                        'bg-purple-100 border border-purple-300': selected === 'itSupport',
                                        '': selected !==
                                            'itSupport'
                                    }">IT
                                    Support</label>

                                <input type="radio" name="personality" id="custormerSupport"
                                    value="custormerSupport" hidden x-model="selected">
                                <label for="custormerSupport"
                                    class="font-semibold capitalize bg-gray-100 border rounded p-2 cursor-pointer"
                                    :class="{
                                        'bg-purple-100 border border-purple-300': selected ===
                                            'custormerSupport',
                                        '': selected !== 'custormerSupport'
                                    }">Custormer
                                    Support</label>
                            </div>

                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
                                <div class="space-y-2 ">
                                    <h1 class=" font-bold mb-2 underline">General</h1>
                                    <label for="name" class="font-senibold">Bot name<span
                                            class="text-red-400 ml-1">*</span></label>
                                    <input id="name" type="text" name="name"
                                        placeholder="Search conversation" class="form-control" autocomplete="false"
                                        value="{{ old('name') }}">
                                    <label for="description" class="font-senibold">Bot Description</label>
                                    <textarea id="description" rows="2" class="  focus:ring-transparent form-control" name="description"
                                        autocomplete="false"></textarea>

                                    <h1 class=" font-bold mb-2 underline">Model <span
                                            class="text-red-400 ml-1">*</span> </h1>
                                    <label for="gpt-3"
                                        class="mx-2 bg-gray-50 cursor-pointer hover:bg-gray-100  rounded px-3  py-5 flex  items-center">
                                        <input type="radio" name="model" id="gpt-3" value="gpt-3.5-turbo"
                                            checked class="mr-2">
                                        GPT-3.5

                                    </label>
                                    <label for="gpt-4"
                                        class="mx-2 bg-gray-50 cursor-pointer hover:bg-gray-100  rounded px-3  py-5 flex  items-center">
                                        <input type="radio" name="model" id="gpt-4" value="gpt-4"
                                            class="mr-2">
                                        GPT-4

                                    </label>
                                </div>
                                <div class="space-y-2 ">
                                    <h1 class=" font-bold mb-2 underline">Knowledge <span
                                            class="text-red-400 ml-1">*</span></h1>

                                    <div>

                                        @forelse ($contents as $content)
                                            <input type="checkbox" name="knowledge[]" id="{{ $content->id }}"
                                                value="{{ $content->id }}">
                                            <label for="{{ $content->id }}"
                                                class="mr-3 cursor-pointer">{{ $content->title }}</label>
                                        @empty
                                            <div class="text-green-400 bg-green-50 border border-green-400 p-3 rounded  ">
                                                <span>Add contents for the bot to function on. </span>
                                                <a href="{{ route('contents.index') }}"
                                                    class="text-gray-700 underline"> Go to contents</a>
                                            </div>
                                        @endforelse
                                    </div>


                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="space-x-3">
                        <x-main-button type="submit" class="text-gray-50" onclick="document.getElementById('form').submit()">Create</x-main-button>
                        <button class="bg-gray-50 text-purple-700 shadow-inner border items-center  px-3  text-center  rounded hover:shadow-lg transition duration-300 py-2 text-xs font-semibold   disabled:opacity-25  ease-in-out"
                            @click="isOpen = false">Cancle</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- modal-2 --}}
        @foreach ($bots as $bot)
            <div class="fixed items-center justify-center my-0  flex top-0 left-0 mx-auto w-full h-full bg-gray-600 bg-opacity-20 z-10 transition duration-1000 ease-in-out"
                x-show="openModal" style="display: none;">
                <div
                    class="bg-white w-[90%] lg:w-[70%]  shadow-inner  border rounded-lg overflow-auto  pb-6 px-5 transition-all relative duration-700">
                    <div class="space-y-5 pt-5 ">
                        <div><button @click="openModal = false"><i class="bx bx-x text-xl font-bold"></i></button>
                        </div>
                        <span class="text-xl font-bold">Edit Bot</span>



                        <form action="{{ route('bots.update', ['bot' => $bot->id]) }}" method="POST" id="form2">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="botId" :value="bot.id">

                            <div class="space-y-5">
                                <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
                                    <div class="space-y-2 " x-data="{ isChecked: '' }">
                                        <h1 class=" font-bold mb-2 underline">General</h1>
                                        <label for="name" class="font-senibold">Bot name<span
                                                class="text-red-400 ml-1">*</span></label>
                                        <input id="name" type="text" name="name" placeholder=""
                                            class="form-control" autocomplete="false" :value="bot.name">
                                        <label for="description" class="font-senibold">Bot Description</label>
                                        <textarea id="description" rows="2" class="  focus:ring-transparent form-control" name="description"
                                            :value="bot.description" autocomplete="false"></textarea>

                                        <h1 class=" font-bold mb-2 underline">Model <span
                                                class="text-red-400 ml-1">*</span> </h1>

                                        <label for="gpt-3" 
                                            class="mx-2 bg-gray-50 cursor-pointer hover:bg-gray-100 rounded px-3 py-5 flex items-center">
                                            <input type="radio" name="model" id="gpt-3"
                                                value="gpt-3.5-turbo" class="mr-2">
                                            GPT-3.5
                                        </label>

                                        <label for="gpt-4"
                                            class="mx-2 bg-gray-50 cursor-pointer hover:bg-gray-100 rounded px-3 py-5 flex items-center">
                                            <input type="radio" name="model" id="gpt-4" value="gpt-4"
                                                class="mr-2">
                                            GPT-4
                                        </label>
                                    </div>
                                    <div class="space-y-2 ">
                                        <h1 class=" font-bold mb-2 underline">Knowledge</h1>

                                        <div>
                                            @foreach ($contents as $content)
                                                <input type="checkbox" name="knowledge[]" id="{{ $content->id }}"
                                                    value="{{ $content->id }}" >
                                                <label for="{{ $content->id }}"
                                                    class="mr-3 cursor-pointer">{{ $content->title }}</label>
                                            @endforeach

                                        </div>


                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="space-x-3">
                            <x-main-button type="submit" class="text-gray-50" onclick="document.getElementById('form2').submit()">Update</x-main-button>
                            <button class="bg-gray-50 text-purple-700 shadow-inner border items-center  px-3  text-center  rounded hover:shadow-lg transition duration-300 py-2 text-xs font-semibold   disabled:opacity-25  ease-in-out"
                                @click="openModal = false">Cancle</button>
                        </div>



                    </div>
                </div>
            </div>
        @endforeach


    </div>


</x-app-layout>
