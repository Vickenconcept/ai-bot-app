<nav class="bg-purple-900 sticky top-0 z-50" x-data="{ openMobileMenue: false, open: true }">
    <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
        <div class="relative flex h-16 items-center justify-between">
            <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                <!-- Mobile menu button-->
                <button type="button" @click="openMobileMenue = !openMobileMenue"
                    class="relative inline-flex items-center justify-center  p-2 text-gray-400 hover:border-b hover:border-gray-300  focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
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
            <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">

                <div class="hidden sm:block">
                    <div class="flex space-x-4">
                        <a href="{{ route('conversations.index') }}"
                            class=" hover:border-b hover:border-gray-300    px-3 py-2 text-sm font-medium text-gray-300 {{ request()->routeIs('conversations.index')||request()->routeIs('conversations.show') ? 'border-b border-gray-300 ' : '' }}" aria-current="page">
                            Chat</a>
                        <a href="{{ route('bots.index') }}"
                            class=" hover:border-b hover:border-gray-300   px-3 py-2 text-sm font-medium text-gray-300 {{ request()->routeIs('bots.index')||request()->routeIs('bots.show') ? 'border-b border-gray-300 ' : '' }}">Bots</a>
                        <a href="{{ route('contents.index') }}"
                            class=" hover:border-b hover:border-gray-300   px-3 py-2 text-sm font-medium text-gray-300 {{ request()->routeIs('contents.index')||request()->routeIs('contents.show') ? 'border-b border-gray-300 ' : '' }}">
                            Contents</a>
                        <a href="{{ route('account.index') }}"
                            class=" hover:border-b hover:border-gray-300   px-3 py-2 text-sm font-medium text-gray-300 {{ request()->routeIs('account.index') ? 'border-b border-gray-300 ' : '' }}">Account</a>
                    </div>
                </div>
            </div>
            <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                <a href="{{ route('support') }}">
                    <button type="button"
                        class="relative rounded-full text-sm px-2 bg-gray-800 py-1 text-gray-400 hover:text-gray-300 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 {{ request()->routeIs('support') ? 'border-2 border-gray-50' : '' }}">
                        Get Help
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
                            <span
                                class="h-8 w-8 rounded-full flex justify-center items-center font-bold  bg-blue-50 ">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                        </button>
                    </div>

                    <div x-show="isOpen" @click.away="isOpen = false" style="display: none"
                        class="absolute right-0 z-10 mt-2 w-48 origin-top-right  bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                        role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                        <!-- Active: "bg-gray-100", Not Active: "" -->
                        <a href="{{ route('profile') }}" class="block px-4 py-2 text-sm text-gray-700" role="menuitem"
                            tabindex="-1" id="user-menu-item-0">Your Profile</a>

                        <form action="{{ route('auth.logout') }}" method="POST">
                            @csrf

                            <a href="javascript:void(0)" onclick="logout(this)"
                                class="block px-4 py-2 text-sm text-gray-700">Sign out</a>
                        </form>
                        <a href="{{ route('home') }}" 
                                class="block px-4 py-2 text-sm text-gray-700">Dashboard</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div class="sm:hidden" id="mobile-menu" x-show="openMobileMenue">
        <div class="space-y-1 px-2 pb-3 pt-2">
            <a href="{{ route('conversations.index') }}"
                class=" text-gray-300 hover:border-b hover:border-gray-300  block  px-3 py-2 text-base font-medium text-gray-300"
                aria-current="page">Chat</a>
            <a href="{{ route('bots.index') }}"
                class="text-gray-300 hover:border-b hover:border-gray-300  block  px-3 py-2 text-base font-medium text-gray-300">Bots</a>
            <a href="{{ route('contents.index') }}"
                class="text-gray-300 hover:border-b hover:border-gray-300  block  px-3 py-2 text-base font-medium text-gray-300">Contents</a>
            <a href="{{ route('account.index') }}"
                class="text-gray-300 hover:border-b hover:border-gray-300  block  px-3 py-2 text-base font-medium text-gray-300">Account</a>
        </div>
    </div>
</nav>
