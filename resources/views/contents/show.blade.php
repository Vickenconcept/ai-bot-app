@extends('contents.content')

@section('content')
    <div class=" text-gray-700  px-4 lg:px-8 space-y-5 pt-4 ">
        <div class="sticky top-16 py-2 boder-b bg-white">
            <a href="{{ route('contents.index') }}"
                class=" font-bold tracking-wider text-xl capitalize"> <i class='bx bxs-chevron-left'></i>
                {{ $contentTitle->title }}
            </a>
            {{-- <button><i class='bx bx-dots-vertical-rounded'></i></button> --}}
        </div>
        <hr>
        <livewire:content-view  :$body :$contentTitle/>

    </div>
@endsection
