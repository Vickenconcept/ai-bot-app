<x-guest-layout>
    <div class="flex flex-col min-h-full justify-center bg-purple-200">
        <div class="   px-6 py-12 lg:px-8 bg-[#1a001a] rounded-3xl w-full md:w-[60%] lg:w-[40%] mx-auto">

            <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                <div class="flex justify-center space-x-1">
                    <i class="bx bx-bot text-purple-500 text-3xl"></i>

                    <h1 class="text-gray-50 text-2xl"><b>Bot</b>Convert</h1>
                </div>
                <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-50">Sign in to your
                    account</h2>
                <p class="text-xs text-gray-500 text-center">Add Your Datails</p>
            </div>

            <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
                @if (session()->has('invalidCredential'))
                    <div class="mb-4 rounded-lg bg-red-100 px-6 py-5 text-base text-red-700" role="alert">
                        {{ session('invalidCredential') }}
                    </div>
                @endif
                <form class="space-y-6" action="{{ route('auth.login') }}" method="POST">
                    @csrf

                    <div>
                        <label for="email" class="input-label text-gray-400">Email address</label>
                        <div class="mt-2">
                            <input id="email" name="email" value="{{ old('email') }}" type="email"
                                autocomplete="email" class="form-control2" placeholder="exmple@gmail.com">
                            @error('email')
                                <span class="text-xs text-red-400">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <div class="flex items-center justify-between">
                            <label for="password" class="input-label text-gray-400">Password</label>
                        </div>
                        <div class="mt-2">
                            <input id="password" name="password" type="password" autocomplete="current-password"
                                class="form-control2" placeholder="********">
                            @error('password')
                                <span class="text-xs text-red-400">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="btn-primary2">Sign in</button>
                    </div>
                </form>

                <p class="mt-10  text-sm text-gray-500 text-right">
                    <a href="{{ route('password.request') }}"
                        class="font-semibold leading-6 text-gray-400 hover:text-gray-500">Forgot your password?</a>
                </p>
                {{-- <p class="mt-10 text-center text-sm text-gray-500">
        Don't have Account?
        <a href="{{ route('register') }}" class="font-semibold leading-6 text-purple-600 hover:text-purple-500">Register</a>
      </p> --}}
            </div>
        </div>
    </div>
</x-guest-layout>
