<div>
    <div class="flex justify-between py-3">
        <div>
            <x-main-button @click="openModal = true" class="text-purple-50"><i class="bx bx-plus"></i> Create
                User</x-main-button>
        </div>
        <form class="flex justify-end w-1/2">
            <input class="form-control  w-full md:w-1/2" type="search" placeholder="Search" aria-label="Search"
                wire:model.live="search">
            {{-- <button class="btn btn-outline-success" type="submit" id="search-btn">Search</button> --}}
        </form>
    </div>
    <div class="relative  shadow-md sm:rounded-lg ">
        <table class="w-full text-sm text-left text-gray-500 ">
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
                            <form class="" action="{{ route('reseller.destroy', ['reseller' => $user->id]) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class=" px-4 py-2 text-red-400 bg-red-100 rounded-md flex items-center">
                                    {{-- <i class='bx bx-x text-xl font-extrabold'></i> --}}
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                      </svg>
                                      
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
        </table>

        {{ $users->links() }}
    </div>
</div>
