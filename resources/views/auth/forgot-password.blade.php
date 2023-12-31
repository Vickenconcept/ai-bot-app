
<x-guest-layout>
    <div class="w-full h-screen flex justify-center items-center p-7 bg-purple-200 ">
        <div class= "w-full sm:w-[50%] lg:w-[40%] bg-[#1a001a]  rounded-xl shadow-md p-7 sm:p-10">
            <h3 class="mb-4 text-xl font-semibold sm:text-center sm:mb-6 sm:text-2xl text-gray-50">
                Change Your password
            </h3>
            @if ($errors->any())
            <div class="bg-red-50 text-red-300  p-3 border border-red-300 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
           
        @endif
            <form method="POST" action="{{ route('password.email') }}" class="w-full">
                @csrf

                <div class="mt-4">
                    <label for="email" :value="__('Email')"></label>

                    <input id="email" class=" form-control2" type="email" name="email" required
                        autocomplete="current-email" placeholder="Enter your email address" />

                </div>
                <div class="flex items-center justify-end mt-4">
                    <button class=" btn-primary2">
                        {{ __('Reset') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
