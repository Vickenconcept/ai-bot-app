<nav class="bg-purple-200 sticky top-0 z-50" x-data="{ openMobileMenue: false, open: true }">
    {{-- <nav class="bg-purple-200 sticky top-0 z-50" x-data="{ openMobileMenue: false, open: true }"> --}}
    <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
        <div class="relative flex h-16 items-center justify-between">
            <a href="{{ route('conversations.index') }}" class="text-xl hidden sm:block">
                <i class="bx bxs-bot text-2xl text-purple-800"></i>
                <b>Bot</b>Convert
            </a>
            <div class="absolute inset-y-0 left-0 flex  items-center sm:hidden">
                <!-- Mobile menu button-->
                <button type="button" @click="openMobileMenue = !openMobileMenue"
                    class="relative inline-flex items-center justify-center p-2 text-gray-400 hover:border-b hover:border-purple-950  focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                    aria-controls="mobile-menu" aria-expanded="false">
                    <span class="absolute -inset-0.5"></span>
                    <span class="sr-only">Open main menu</span>

                    <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                    <svg class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="flex flex-2 items-center justify-center sm:items-stretch sm:justify-start">

                <div class="hidden sm:block">
                    <div class="flex space-x-4">
                        <a href="{{ route('conversations.index') }}"
                            class=" hover:border-b hover:border-purple-950   px-3 py-2 text-sm font-medium text-purple-950 {{ request()->routeIs('conversations.index') || request()->routeIs('conversations.show') ? 'border-b border-purple-950 bg-purple-300 rounded bg-opacity-30 ' : '' }}"
                            aria-current="page">
                            <i class='bx bx-conversation mr-1 text-sm'></i>
                            Chat
                        </a>
                        <a href="{{ route('bots.index') }}"
                            class=" hover:border-b hover:border-purple-950  px-3 py-2 text-sm font-medium text-purple-950 {{ request()->routeIs('bots.index') || request()->routeIs('bots.show') ? 'border-b border-purple-950 bg-purple-300 rounded bg-opacity-30 ' : '' }}">
                            <i class='bx bx-bot mr-1 text-sm'></i>
                            Bots</a>
                        <a href="{{ route('contents.index') }}"
                            class=" hover:border-b hover:border-purple-950  px-3 py-2 text-sm font-medium text-purple-950 {{ request()->routeIs('contents.index') || request()->routeIs('contents.show') ? 'border-b border-purple-950 bg-purple-300 rounded bg-opacity-30 ' : '' }}">
                            <i class='bx bx-file mr-1 text-sm'></i>
                            Contents</a>
                        <a href="{{ route('account.index') }}"
                            class=" hover:border-b hover:border-purple-950  px-3 py-2 text-sm font-medium text-purple-950 {{ request()->routeIs('account.index') ? 'border-b border-purple-950 bg-purple-300 rounded bg-opacity-30 ' : '' }}">
                            <i class='bx bx-user mr-1 text-sm'></i>
                            Account</a>
                    </div>
                </div>
            </div>
            <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                <a href="{{ route('support') }}">
                    <button type="button"
                        class="relative rounded-full text-sm px-2 bg-gray-800 py-1 text-gray-400 hover:text-purple-50 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 {{ request()->routeIs('support') ? 'border-2 border-gray-50' : '' }}">
                    Training Videos
                    </button>
                </a>

                <!-- Profile dropdown -->
                <div class="relative ml-3" x-data="{ isOpen: false }">
                    <div>
                        <button type="button" @click="isOpen = !isOpen"
                            class="relative flex rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                            id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                            <span class="absolute -inset-1.5"></span>
                            <span class="sr-only">Open user menu</span>
                            {{-- <span
                                class="h-8 w-8 rounded-full flex justify-center items-center font-bold  bg-blue-50 ">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span> --}}
                        </button>
                        <p class="cursor-pointer" @click="isOpen = !isOpen"><b>welcome </b>, {{ auth()->user()->name }}
                        </p>
                    </div>

                    <div x-show="isOpen" @click.away="isOpen = false" style="display: none"
                        class="absolute right-0 z-10 mt-2 w-48 origin-top-right  bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                        role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                        <!-- Active: "bg-gray-100", Not Active: "" -->
                        <a href="{{ route('profile') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-purple-200" role="menuitem"
                            tabindex="-1" id="user-menu-item-0">Your Profile</a>

                        <form action="{{ route('auth.logout') }}" method="POST">
                            @csrf

                            <a href="javascript:void(0)" onclick="logout(this)"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-purple-200">Sign out</a>
                        </form>
                        <a href="{{ route('home') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-purple-200">Dashboard</a>

                        @role(['fast_pass_bundle'])
                            <a href="{{ route('reseller.index') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-purple-200">Reseller</a>
                            <a href="{{ route('affiliate_marketing') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-purple-200">Affiliate
                                Marketing Coaching </a>
                            <a href="{{ route('dfy_traffic') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-purple-200">DFY Unlimited Traffic</a>
                            <a href="{{ route('dfy_ai') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-purple-200">DFY Ai Automation
                                Marketing Agency</a>
                        @endrole

                        @role(['dfy_ai'])
                            <a href="{{ route('dfy_ai') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-purple-200">DFY Ai Automation
                                Marketing Agency</a>
                        @endrole
                        @role(['unlimited_traffic'])
                            <a href="{{ route('dfy_traffic') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-purple-200">DFY Unlimited Traffic</a>
                        @endrole
                        @role(['reseller'])
                            <a href="{{ route('reseller.index') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-purple-200">Reseller</a>
                        @endrole
                        @role(['affiliate_coaching'])
                            <a href="{{ route('affiliate_marketing') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-purple-200">Affiliate
                                Marketing Coaching </a>
                        @endrole


                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div class="sm:hidden" id="mobile-menu" x-show="openMobileMenue">
        <div class="space-y-1 px-2 pb-3 pt-2">
            <a href="{{ route('conversations.index') }}"
                class=" text-purple-950 hover:border-b hover:border-purple-950  block px-3 py-2 text-base font-medium text-purple-950"
                aria-current="page">Chat</a>
            <a href="{{ route('bots.index') }}"
                class="text-purple-950 hover:border-b hover:border-purple-950  block px-3 py-2 text-base font-medium text-purple-950">Bots</a>
            <a href="{{ route('contents.index') }}"
                class="text-purple-950 hover:border-b hover:border-purple-950  block px-3 py-2 text-base font-medium text-purple-950">Contents</a>
            <a href="{{ route('account.index') }}"
                class="text-purple-950 hover:border-b hover:border-purple-950  block px-3 py-2 text-base font-medium text-purple-950">Account</a>
        </div>
    </div>
</nav>
