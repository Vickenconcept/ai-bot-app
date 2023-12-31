<x-guest-layout>
    <div class="flex flex-col min-h-full justify-center bg-purple-200">
        <div class="   px-6 py-8 lg:px-8 bg-[#1a001a] rounded-3xl w-full md:w-[60%] lg:w-[40%] mx-auto">
            <div class="sm:mx-auto sm:w-full sm:max-w-sm">
              <div class="flex justify-center space-x-1">
                <i class="bx bx-bot text-purple-500 text-3xl"></i>

                <h1 class="text-gray-50 text-2xl"><b>Bot</b>Convert</h1>
               </div>
                <h2 class=" text-center text-2xl font-bold leading-9 tracking-tight text-gray-50">Sign in to your
                    account</h2>
            </div>


            <div class=" sm:mx-auto sm:w-full sm:max-w-sm">
                @if ($errors->any())
                    <div class="bg-red-50 text-red-300  p-3 border border-red-300 rounded">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form class="space-y-3" action="{{ route('auth.register') }}" method="POST">
                    @csrf
                    <div>
                        <label for="name" class="input-label text-gray-400">Name</label>
                        <div class="mt-2">
                            <input id="name" name="name" value="{{ old('name') }}" type="text"
                                autocomplete="name" class="form-control2" placeholder="Smith Joe">
                            @error('name')
                                <span class="text-xs text-red-400">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="username" class="input-label text-gray-400">Username</label>
                        <div class="mt-2">
                            <input id="username" name="username" value="{{ old('username') }}" type="text"
                                autocomplete="username" class="form-control2" placeholder="Joe2">
                            @error('username')
                                <span class="text-xs text-red-400">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="email" class="input-label text-gray-400">Email Address</label>
                        <div class="mt-2">
                            <input id="email" name="email" value="{{ old('email') }}" type="text"
                                autocomplete="email" class="form-control2" placeholder="example@gmail.com">
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
                        <div class="flex items-center justify-between">
                            <label for="password_confirmation" class="input-label text-gray-400">Password Confirmation</label>
                        </div>
                        <div class="mt-2">
                            <input id="password_confirmation" name="password_confirmation" type="password"
                                autocomplete="current-password" class="form-control2" placeholder="********">
                        </div>
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="btn-primary2  ">Sign in</button>
                    </div>
                </form>

                <p class="mt-5 text-center text-sm text-gray-500">
                    Already registerd?
                    <a href="{{ route('login') }}"
                        class="font-semibold leading-6 text-purple-600 hover:text-purple-500">Login</a>
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>
