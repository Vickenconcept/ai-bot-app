<x-app-layout>
    <div class="w-full lg:w-[80%] mx-auto text-gray-700  px-4 lg:px-8 space-y-5 pt-4 pb-8 ">
        <div class="sticky top-16 py-2 boder-b bg-purple-50">
            <a href="{{ route('contents.index') }}" class=" font-bold tracking-wider text-md capitalize"> 
                <i class='bx bx-left-arrow-alt mr-2 rounded-full bg-purple-200 p-2' ></i>Back to folder
            </a>
            {{-- <button><i class='bx bx-dots-vertical-rounded'></i></button> --}}
        </div>
        <hr>
        <livewire:content-view :$body :$contentTitle />

    </div>
</x-app-layout>
