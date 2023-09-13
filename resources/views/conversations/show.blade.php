@extends('conversations.conversations')

@section('content')
  <div class=" text-gray-700"> 
    <div class=" lg:hidden p-5"><a href="{{ route('conversations.index') }}" class=" font-bold tracking-wider text-xl"> <i class='bx bxs-chevron-left'></i> {{ $conversationTitle->title }} </a></div>
    <ul class="">
        @foreach ($body as $content)
        <div class="{{ $content->sender !== 'bot' ? 'bg-white' : 'bg-gray-100' }}">

            <div class="flex space-x-5  py-10 w-[90%] md:w-[70%] mx-auto " >
                <img class="h-8 w-8 rounded-full"
            src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
            alt="">
                <li class>
                    {{ $content->message }}</li>
            </div>
        </div>
        @endforeach
        
    </ul>
  </div>
    @endsection
