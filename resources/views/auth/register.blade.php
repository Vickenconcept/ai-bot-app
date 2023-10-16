<x-guest-layout>
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
      <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <h2 class=" text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Sign in to your account</h2>
      </div>

      <div class=" sm:mx-auto sm:w-full sm:max-w-sm">
        <form class="space-y-6" action="{{ route('auth.register') }}" method="POST">
            @csrf
          <div>
            <label for="name" class="input-label">Name</label>
            <div class="mt-2">
              <input id="name" name="name" value="{{ old('name') }}" type="text" autocomplete="name" class="form-control">
              @error('name')
                  <span class="text-xs text-red-400">{{ $message }}</span>
              @enderror
            </div>
          </div>
          
          <div>
            <label for="username" class="input-label">Username</label>
            <div class="mt-2">
              <input id="username" name="username" value="{{ old('username') }}" type="text" autocomplete="username" class="form-control">
              @error('username')
                  <span class="text-xs text-red-400">{{ $message }}</span>
              @enderror
            </div>
          </div>

          <div>
            <label for="email" class="input-label">Email Address</label>
            <div class="mt-2">
              <input id="email" name="email" value="{{ old('email') }}" type="text" autocomplete="email" class="form-control">
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
            <div class="flex items-center justify-between">
              <label for="password_confirmation" class="input-label">Password Confirmation</label>
            </div>
            <div class="mt-2">
              <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="current-password" class="form-control">
            </div>
          </div>
  
          <div>
            <button type="submit" class="btn-primary ">Sign in</button>
          </div>
        </form>
  
        <p class="mt-10 text-center text-sm text-gray-500">
         Already registerd?
          <a href="{{ route('login') }}" class="font-semibold leading-6 text-purple-600 hover:text-purple-500">Login</a>
        </p>
      </div>
    </div>
  </x-guest-layout>
  
