<x-guest-layout>
  <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
    
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
      <img class="mx-auto h-10 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=purple&shade=600" alt="Your Company">
      <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Sign in to your account</h2>
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
          <label for="email" class="input-label">Email address</label>
          <div class="mt-2">
            <input id="email" name="email" value="{{ old('email') }}" type="email" autocomplete="email" class="form-control">
            @error('email')
                <span class="text-xs text-red-400">{{ $message }}</span>
            @enderror
          </div>
        </div>

        <div>
          <div class="flex items-center justify-between">
            <label for="password" class="input-label">Password</label>
          </div>
          <div class="mt-2">
            <input id="password" name="password" type="password" autocomplete="current-password" class="form-control">
            @error('password')
                <span class="text-xs text-red-400">{{ $message }}</span>
            @enderror
          </div>
        </div>

        <div>
          <button type="submit" class="btn-primary">Sign in</button>
        </div>
      </form>

      <p class="mt-10  text-sm text-gray-500 text-right">
        <a href="{{ route('password.request') }}" class="font-semibold leading-6 text-purple-600 hover:text-purple-500">Forgot your password?</a>
      </p>
      {{-- <p class="mt-10 text-center text-sm text-gray-500">
        Don't have Account?
        <a href="{{ route('register') }}" class="font-semibold leading-6 text-purple-600 hover:text-purple-500">Register</a>
      </p> --}}
    </div>
  </div>
</x-guest-layout>
