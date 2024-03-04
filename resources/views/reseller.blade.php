<x-app-layout>
    <x-notification />

    <div x-data="{ openModal: false }" class="m-4 lg:m-10 space-y-5 pb-50 ">

        @if ($errors->any())
            <div class="bg-red-300">
                <ul class="mb-4 rounded-lg bg-red-100 px-6 py-5 text-base text-red-700">
                    @foreach ($errors->all() as $error)
                        <li class="text-red-400">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- modal --}}
        <div class="fixed items-center justify-center  flex top-0 left-0 mx-auto w-full h-full bg-gray-600 bg-opacity-20 z-50 transition duration-1000 ease-in-out"
            x-show="openModal" style="display: none;">
            <div @click.away="openModal = false"
                class="bg-[#1a001a] w-[70%] lg:w-[40%] shadow-inner  border rounded-lg overflow-auto  pb-6 px-5 transition-all relative duration-700">
                <div class="space-y-5 pt-5 ">
                    <form class="space-y-3" action="{{ route('reseller.store') }}" method="POST">
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
                                <label for="password_confirmation" class="input-label text-gray-400">Password
                                    Confirmation</label>
                            </div>
                            <div class="mt-2">
                                <input id="password_confirmation" name="password_confirmation" type="password"
                                    autocomplete="current-password" class="form-control2" placeholder="********">
                            </div>
                        </div>

                        <div class="pt-3">
                            <button type="submit" class="btn-primary2  ">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div >
            {{-- <table class="w-full text-sm text-left text-gray-500 ">
                <thead class="text-xs text-gray-700 uppercase bg-purple-200  ">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Email
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Date Joined
                        </th>

                        <th scope="col" class="px-6 py-3">
                            <span class="sr-only">Edit</span>
                        </th>
                    </tr>
                </thead>
                <tbody>

                    @forelse ($users as $user)
                        <tr class=" border-b  hover:bg-purple-100 ">
                            <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap capitalize">
                                {{ $user->name }}
                            </td>
                            <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap capitalize">
                                {{ $user->email }}
                            </td>
                            <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap capitalize">
                                {{ $user->created_at }}
                            </td>
                            <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap capitalize">
                                <form class="" action="{{ route('reseller.destroy', ['reseller' => $user]) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class=" px-4 py-2">
                                        <i class='bx bx-x text-xl'></i>
                                        {{ __('Delete') }}

                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <td scope="row" colspan="4"
                            class="px-6 py-4 font-medium text-gray-900 text-center whitespace-nowrap capitalize">
                            No Resell Yet
                        </td>
                    @endforelse
                </tbody>
            </table> --}}
            <livewire:resell-table />
        </div>
    </div>


</x-app-layout>
