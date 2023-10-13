<x-app-layout>
    <x-notification />
    <div class="grid grid-cols-1 px-5  h-full relative text-gray-700" x-data="{ isOpen: false }">
        {{-- <div class="lg:col-span-2 hidden lg:block">
            <div class="col-span-2 p-3 bg-purple-900  h-screen fixed  lg:block  lg:w-[315px] space-y-5">
                <hr class="hidden lg:block">
                <ul class="space-y-5">
                    <a href="{{ route('account.index') }}" class="block">
                        <li class="text-gray-100  flex  text-md tracking-wide capitalize">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                            </svg>

                            Users
                        </li>
                    </a>
                    <a href="#" class="block">
                        <li class="text-gray-100  flex  text-md tracking-wide capitalize">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>


                            Billing
                        </li>
                    </a>
                    @if (Auth::user()->referrer_id === null)
                        <a href="#" class="block">
                            <li class="text-gray-100  flex  text-md tracking-wide capitalize">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M14.25 9.75L16.5 12l-2.25 2.25m-4.5 0L7.5 12l2.25-2.25M6 20.25h12A2.25 2.25 0 0020.25 18V6A2.25 2.25 0 0018 3.75H6A2.25 2.25 0 003.75 6v12A2.25 2.25 0 006 20.25z" />
                                </svg>


                                API Keys
                            </li>
                        </a>
                    @endif

                </ul>
            </div>
        </div> --}}

        {{-- <div class="col-span-8 lg:hidden ">
            <hr>
            <div class=" p-3 bg-purple-900  text-gray-50   lg:w-[315px] space-x-5">
                <a href="{{ route('account.index') }}" class="">
                    Users
            </a
                <a href="#" class="">
                    Billing
                </a>
                @if (Auth::user()->referrer_id === null)
                    <a href="#" class="">
                        API Keys
                    </a>
                @endif

            </div>

        </div> --}}

        <section class=" h-full space-y-5 p-5 ">
            @if (Auth::user()->referrer_id === null)
                <h1 class="font-bold text-xl">Invitation link</h1>
                <p>Share this secret link to invite people to this team.
                    Only users who are owners can see this. <br> You can also change your username to reset this link.
                </p>

                <div class="grid grid-cols-1 md:grid-cols-3">
                    <div class="flex flex-wrap    items-center col-span-1 md:col-span-2">
                        <div class=" bg-gray-800 text-gray-50 rounded-tl rounded-bl">
                            <p id="invite" class="w-full  p-2  text-sm font-semibold shadow-inner ">
                                {{-- {{ route('guests.show', ['guest' => $guestChat->uuid]) }} --}}
                                {{ auth()->user()->generateReferralLink() }}
                            </p>
                        </div>
                        <div class="">
                            <button onclick="toCopy(document.getElementById('invite'))"
                                class=" bg-purple-800 px-4 py-2 text-white  rounded-tr rounded-br text-sm font-semibold   shadow-sm hover:shadow-md  ">Copy
                            </button>
                        </div>
                    </div>
                </div>
            @endif

            <div class="space-y-5 ">
                <div class="flex justify-between">
                    <h1 class="text-xl font-semibold">Users</h1>
                    @if (Auth::user()->referrer_id === null)
                        <div>
                            <x-main-button @click="isOpen = true" class="text-gray-50"> <i
                                    class='bx bx-user-plus text-md'></i> Invite</x-main-button>
                        </div>
                    @endif
                </div>
                <hr>
                @if (Auth::user()->referrer_id === null)
                    <div class="text-red-400 bg-red-50 border border-red-400 p-3 rounded  mt-5 w-full">
                        <span>Note: once your referral's access level is updated to <b>owner</b>, they leave your team
                            and become independent </span>
                    </div>
                    <h1>Referrals: {{ count(Auth::user()->referrals) ?? '0' }}</h1>
                @endif
                <div class="overflow-auto">
                    <table class="w-full text-sm text-left text-gray-500 ">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50  ">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Users
                                </th>
                                <th scope="col" class="px-6 py-3 ">
                                    Access Level
                                </th>

                                <th scope="col" class="px-6 py-3 ">
                                    Created At
                                </th>
                                <th scope="col" class="px-6 py-3 ">

                                </th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg-white border-b  hover:bg-gray-50 ">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap capitalize">
                                    {{ auth()->user()->name }}
                                </th>
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap capitalize">
                                    {{-- {{ Auth::user()->referrer->name }} --}}
                                    @if (Auth::user()->referrer_id === null)
                                        Owner
                                    @else
                                        Memeber
                                    @endif
                                </th>
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap capitalize">
                                    {{ auth()->user()->created_at }}
                                </th>
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap capitalize">

                                </th>
                            </tr>
                            @if (Auth::user()->referrer_id === null)
                                @foreach ($referrals as $referral)
                                    <tr class="bg-white border-b  hover:bg-gray-50 ">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap capitalize">
                                            {{ $referral->name }}
                                        </th>
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap capitalize flex">
                                            Memeber
                                            <x-dropdown>
                                                <x-slot name="trigger">
                                                    <button><i
                                                            class='bx bx-expand-vertical  transition duration-300  py-2 px-3'></i></button>

                                                </x-slot>
                                                <x-slot name="content">

                                                    <x-dropdown-link class="cursor-pointer ">
                                                        <form
                                                            action="{{ route('account.update', ['account' => $referral->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="access" value="member">
                                                            <button type="submit" class="w-full text-left flex">Member
                                                            </button>
                                                        </form>

                                                    </x-dropdown-link>
                                                    <x-dropdown-link class="cursor-pointer ">
                                                        <form
                                                            action="{{ route('account.update', ['account' => $referral->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="access" value="owner">
                                                            <button type="submit" class="w-full text-left flex">Owner
                                                            </button>
                                                        </form>

                                                    </x-dropdown-link>
                                                </x-slot>
                                            </x-dropdown>
                                        </th>
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap capitalize">
                                            {{ $referral->created_at }}
                                        </th>
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap capitalize">
                                            <x-dropdown>
                                                <x-slot name="trigger">
                                                    <button><i
                                                            class='bx bx-dots-vertical-rounded  transition duration-300  py-2 px-3'></i></button>
                                                </x-slot>
                                                <x-slot name="content">

                                                    <x-dropdown-link class="cursor-pointer ">
                                                        <form
                                                            action="{{ route('account.destroy', ['account' => $referral->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')

                                                            <button type="submit"
                                                                class="w-full text-left flex">Delete
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 24 24" stroke-width="1.5"
                                                                    stroke="currentColor" class=" ml-1 w-4 h-4">
                                                                    <path stroke-linecap="round"
                                                                        stroke-linejoin="round"
                                                                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                                </svg>

                                                            </button>
                                                        </form>

                                                    </x-dropdown-link>
                                                </x-slot>
                                            </x-dropdown>
                                        </th>
                                    </tr>
                                @endforeach
                            @else
                            @endif
                        </tbody>
                    </table>
                </div>

                <div class="fixed items-center justify-center  flex top-0 left-0 mx-auto w-full h-full bg-gray-600 bg-opacity-20 z-10 transition duration-1000 ease-in-out"
                    x-show="isOpen" style="display: none;">
                    <div @click.away="isOpen = false"
                        class="bg-white w-[70%] lg:w-[50%] shadow-inner  border rounded-lg overflow-auto  pb-6 px-5 transition-all relative duration-700">
                        <div class=" pt-5 ">
                            <div><button @click="isOpen = false"><i class="bx bx-x text-xl font-bold"></i></button>
                            </div>

                            <div class="space-y-5">
                                <div class="text-center">
                                    <h1 class="text-md font-semibold">Invite your team member</h1>
                                    <p class="text-sm">Each user in your team can upload their own documents and
                                        create private conversations with Cody but only owners can invite other
                                        users.
                                    </p>
                                </div>
                                <div>
                                    <form class="space-y-6" action="{{ route('invite') }}" method="GET">
                                        @csrf
                                        <div class="grid grid-cols-1 md:grid-cols-2  w-full gap-5">
                                            <div>
                                                <div class="flex items-center justify-between">
                                                    <label for="email" class="input-label">Email</label>
                                                </div>
                                                <div class="mt-2">
                                                    <input id="email" name="email" type="email"
                                                        autocomplete="off" class="form-control" value="">
                                                    @error('email')
                                                        <span class="text-xs text-red-400">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="mt-2">
                                                <div class="flex items-center justify-between">
                                                    <label for="access" class="input-label">Acces</label>
                                                </div>
                                                <select id="access" name="access"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5 ">

                                                    <option value="{{ route('register') }}">Owner </option>
                                                    <option value="{{ auth()->user()->generateReferralLink() }}">
                                                        Member</option>
                                                </select>
                                            </div>
                                            <div>
                                                <x-main-button type="submit" class="text-gray-50">
                                                    <i class='bx bx-mail-send text-md'></i>
                                                    <span class="text-md">Invite</span></x-main-button>
                                            </div>

                                        </div>

                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

        </section>
        <script>
            function toCopy(copyDiv) {
                var range = document.createRange();
                range.selectNode(copyDiv);
                window.getSelection().removeAllRanges();
                window.getSelection().addRange(range);
                document.execCommand("copy");
                // alert("copied!");
            }
        </script>
    </div>

</x-app-layout>
