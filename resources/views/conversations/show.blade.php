@extends('conversations.conversations')

@section('content')
    <x-notification />
    <div class=" text-gray-700  ">
        <div class="sticky top-16 py-2 bg-gray-100 shadow lg:hidden p-5"><a href="{{ route('conversations.index') }}"
                class=" font-bold tracking-wider text-xl"> <i class='bx bxs-chevron-left'></i> {{ $conversationTitle->title }}
            </a></div>
        @if ($conversationTitle->template === 'temp1')
            <livewire:message-view :body="$body" :conversationTitle="$conversationTitle" />
        @else
            <h1>Not found</h1>
        @endif


    </div>
@endsection
