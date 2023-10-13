<x-app-layout>
    <x-notification />
    <div class="w-[80%] mx-auto space-y-8">
        <h1 class="font-bold text-xl my-5">My Profile</h1>
        <hr>

        <div>
            <form action="{{ route('changeName') }}" method="POST" class=" space-y-4 ">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2  w-full gap-5">
                    <div>
                        <div class="flex items-center justify-between">
                            <label for="name" class="input-label">Name</label>
                        </div>
                        <div class="mt-2">
                            <input id="name" name="name" type="name" autocomplete="off"
                                class="form-control" value="{{ auth()->user()->name }}">
                            @error('name')
                                <span class="text-xs text-red-400">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <div class="flex items-center justify-between">
                            <label for="email" class="input-label">Email</label>
                        </div>
                        <div class="mt-2">
                            <input id="email" name="email" type="email" autocomplete="off"
                                class="form-control" value="{{ auth()->user()->email }}">
                            @error('email')
                                <span class="text-xs text-red-400">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2  w-full gap-5">
                    <div>
                        <div class="flex items-center justify-between">
                            <label for="username" class="input-label">Username</label>
                        </div>
                        <div class="mt-2">
                            <input id="username" name="username" type="username" autocomplete="off"
                                class="form-control" value="{{ auth()->user()->username }}">
                            @error('username')
                                <span class="text-xs text-red-400">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    
                </div>

                <div class="" >
                    <button type="submit" class=" bg-purple-600 rounded-lg px-4 py-2 text-white hover:shadow">save</button>
                </div>

               
            </form>
        </div>


        <div class="space-y-5 ">
            <hr>
            <h1 class=" ">Changing your password will log you out of every device except this one.</h1>
            <form action="{{ route('changePassword') }}" method="POSt" class=" space-y-4 ">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2  w-full gap-5">
                    <div>
                        <div class="flex items-center justify-between">
                            <label for="password" class="input-label">Password</label>
                        </div>
                        <div class="mt-2">
                            <input id="password" name="password" type="password" autocomplete="off"
                                class="form-control">
                            @error('password')
                                <span class="text-xs text-red-400">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <div class="flex items-center justify-between">
                            <label for="new_password" class="input-label">New password</label>
                        </div>
                        <div class="mt-2">
                            <input id="new_password" name="new_password" type="new_password" autocomplete="off"
                                class="form-control" value="">
                            @error('new_password')
                                <span class="text-xs text-red-400">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="" >
                    <button type="submit" class=" bg-purple-600 rounded-lg px-4 py-2 text-white hover:shadow">save</button>
                </div>

               
            </form>
        </div>
       
    </div>


</x-app-layout>
