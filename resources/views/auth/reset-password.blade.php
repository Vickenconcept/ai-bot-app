<x-guest-layout>
    <div class="w-full h-screen flex justify-center items-center p-7">
        <div class= "w-full sm:w-[50%] lg:w-[40%] bg-white rounded shadow-md p-7 sm:p-10">
            <h3 class="mb-4 text-xl font-semibold sm:text-center sm:mb-6 sm:text-2xl">
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
            <form method="POST" action="{{ route('password.update') }}" class="w-full">
                @csrf

                <div class="mt-4">
                    <div class="flex items-center justify-between">
                        <label for="password_confirmation" class="input-label">Email</label>
                    </div>

                    <input id="email" class=" form-control" type="email" name="email" required
                        autocomplete="current-email" placeholder="Enter your email address" />

                </div>
                <div class="mt-4">
                    <div class="flex items-center justify-between">
                        <label for="password_confirmation" class="input-label">Password </label>
                    </div>

                    <input id="password" class=" form-control" type="password" name="password" required
                        autocomplete="current-password" placeholder="Enter your password " />

                </div>
                <div class="mt-4">
                    <div class="flex items-center justify-between">
                        <label for="password_confirmation" class="input-label">Password Confirmation</label>
                    </div>
                    <div class="">
                        <input id="password_confirmation" name="password_confirmation" type="password"
                            class="form-control">
                    </div>
                </div>
                <div class="">
                    <input id="token" name="token" type="hidden"  class="form-control" value="{{ $token }}">
                  </div>
                    <div class="flex items-center justify-end mt-4">
                        <button class=" btn-primary">
                            {{ __('Reset') }}
                        </button>
                    </div>
            </form>
        </div>
    </div>
</x-guest-layout>
