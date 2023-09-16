<x-app-layout>

    <div class="   m-10 space-y-5" x-data="{ isOpen: false }">
        <div class="flex justify-end">
            <x-main-button class="text-gray-50 " @click="isOpen = true">+ New Bot</x-main-button>
        </div>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 ">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50  ">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Bot name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Description
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Model
                        </th>
                        <th scope="col" class="px-6 py-3">
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
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                {{ $bot->name }}
                            </th>
                            <td class="px-6 py-4 w-[500px]">
                                {{ $bot->description }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $bot->model }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $bot->created_at }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="#" class="font-medium text-blue-600  hover:underline">Edit</a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        {{-- modal --}}
        <div class="fixed items-center justify-center  flex top-0 left-0 mx-auto w-full h-full bg-gray-600 bg-opacity-20 z-10 transition duration-1000 ease-in-out"
            x-show="isOpen" style="display: none;">
            <div @click.away="isOpen = false"
                class="bg-white w-[70%]  shadow-inner  border rounded-lg overflow-auto  pb-6 px-5 transition-all relative duration-700">
                <div class="space-y-5 pt-5 ">

                    <form action="{{ route('bots.store') }}" method="POST">
                        @csrf

                        <div class="space-y-8">
                            <h1 class=" font-bold mb-2 underline">Persoanality</h1>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-2" x-data="{ selected: null }">

                                <input type="radio" name="personlity" id="factual" value="factual" hidden  x-model="selected" >
                                <label for="factual"
                                    class="font-semibold capitalize bg-gray-100 hover:bg-gray-200 rounded p-2 cursor-pointer " :class="{ 'bg-blue-200 border border-blue-300': selected === 'factual', '': selected !== 'factual' }">factual</label>

                                <input type="radio" name="personlity" id="hr" value="hr" hidden x-model="selected" >
                                <label for="hr"
                                    class="font-semibold upperase bg-gray-100 hover:bg-gray-200 rounded p-2 cursor-pointer" :class="{ 'bg-blue-200 border border-blue-300': selected === 'hr', '': selected !== 'hr' }">HR</label>

                                <input type="radio" name="personlity" id="creative" value="creative" hidden x-model="selected">
                                <label for="creative"
                                    class="font-semibold capitalize bg-gray-100 hover:bg-gray-200 rounded p-2 cursor-pointer" :class="{ 'bg-blue-200 border border-blue-300': selected === 'creative', '': selected !== 'creative' }">Creative</label>

                                <input type="radio" name="personlity" id="tranning" value="tranning" hidden x-model="selected">
                                <label for="tranning"
                                    class="font-semibold capitalize bg-gray-100 hover:bg-gray-200 rounded p-2 cursor-pointer" :class="{ 'bg-blue-200 border border-blue-300': selected === 'tranning', '': selected !== 'tranning' }">Tranning</label>

                                <input type="radio" name="personlity" id="itSupport" value="itSupport" hidden x-model="selected">
                                <label for="itSupport"
                                    class="font-semibold capitalize bg-gray-100 hover:bg-gray-200 rounded p-2 cursor-pointer" :class="{ 'bg-blue-200 border border-blue-300': selected === 'itSupport', '': selected !== 'itSupport' }">IT
                                    Support</label>

                                <input type="radio" name="personlity" id="custormerSupport" value="custormerSupport"
                                    hidden x-model="selected">
                                <label for="custormerSupport"
                                    class="font-semibold capitalize bg-gray-100 hover:bg-gray-200 rounded p-2 cursor-pointer" :class="{ 'bg-blue-200 border border-blue-300': selected === 'custormerSupport', '': selected !== 'custormerSupport' }">Custormer
                                    Support</label>
                            </div>

                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
                                <div class="space-y-3 ">
                                    <h1 class=" font-bold mb-2 underline">General</h1>
                                    <label for="name" class="font-senibold">Bot name</label>
                                    <input id="name" type="text" name="name"
                                        placeholder="Search conversation" class="form-control" autocomplete="false">
                                    <label for="description" class="font-senibold">Bot Description</label>
                                    <textarea id="description" rows="2" class="  focus:ring-transparent form-control" name="description"
                                        autocomplete="false"></textarea>

                                    <div
                                        class="bg-gray-50 cursor-pointer hover:bg-gray-100  rounded px-3  py-5 flex  items-center">
                                        <input type="radio" name="model" id="gpt-3" value="gpt-3.5" checked>
                                        <label for="gpt-3" class="mx-2">GPT-3.5</label>
                                    </div>
                                    <div
                                        class="bg-gray-50 cursor-pointer hover:bg-gray-100  rounded px-3  py-5 flex  items-center">
                                        <input type="radio" name="model" id="gpt-4" value="gpt-4" disabled>
                                        <label for="gpt-4" class="mx-2">GPT-4</label>
                                    </div>
                                </div>
                                <div class="space-y-3 ">
                                    <h1 class=" font-bold mb-2 underline">Knowledge</h1>

                                    <div>
                                        <input type="checkbox" name="knowledge" id="knowledge" value="">
                                        <label for="knowledge" class="mr-3">content 1</label>
                                        <input type="checkbox" name="knowledge-2" id="knowledge-2" value="">
                                        <label for="knowledge-2"  class="mr-3">content 2</label>
                                    </div>


                                </div>
                            </div>
                            <div class="space-x-3">
                                <x-main-button type="submit" class="text-gray-50">Update</x-main-button>
                                <x-main-button class="bg-gray-50 text-blue-700 shadow-inner border"
                                    @click="isOpen = false">Cancle</x-main-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
