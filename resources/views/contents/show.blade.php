@extends('contents.content')

@section('content')
    <div class=" text-gray-700  ">
        <div class="sticky top-16 py-2 bg-gray-50  p-5"><a href="{{ route('contents.index') }}"
                class=" font-bold tracking-wider text-xl"> <i class='bx bxs-chevron-left'></i>
                {{ $contentTitle->title }}
            </a>
            {{-- <button><i class='bx bx-dots-vertical-rounded'></i></button> --}}
        </div>
        {{-- <livewire:message-view  :body="$body" :conversationTitle="$conversationTitle"/> --}}

        this is the show content
    </div>
@endsection
