<x-app-layout>
    <x-notification />
    <div class="text-gray-700" x-data="{ isOpen: 'contacts', openContact: null }">
        <hr>
        <div class="bg-purple-700 px-10 ">
            <ul class=" flex py-2 space-x-5">
                {{-- <a href="#" @click="isOpen = 'contacts'">
                    <li class="py-0.5 px-2 rounded-md text-sm bg-purple-50 hover:bg-purple-300 text-gray-900">Users
                        contacts
                    </li>
                </a> --}}
                <div class="relative ml-3" x-data="{ isOpen: false }">
                    <div>
                        <button type="button" @click="isOpen = !isOpen">
                            <li class="py-0.5 px-2 rounded-md text-sm bg-purple-50 hover:bg-purple-300 text-gray-900">
                                ESP
                            </li>
                        </button>
                    </div>

                    <div x-show="isOpen" @click.away="isOpen = false" style="display: none"
                        class="absolute left-0 z-10 mt-2 w-64 origin-top-right  bg-white  p-3 rounded shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                        role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">

                        <form action="{{ route('home.store') }}" method="post" class="space-y-3">
                            @csrf
                            <h1 class="font-semibold">Mailchimp Credentials</h1>
                            <div>
                                <label class="text-xs font-semibold" for="prefix">Prefix</label>
                                <input type="text" id="prefix" name="prefix" class="form-control" value=""
                                    placeholder="enter prefix">
                                @error('prefix')
                                    <span class="text-xs text-red-400">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label class="text-xs font-semibold" for="api_key">API key</label>
                                <input type="text" id="api_key" name="api_key" class="form-control" value=""
                                    placeholder="enter api key">
                                @error('api_key')
                                    <span class="text-xs text-red-400">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn-primary">Save</button>
                        </form>

                        {{-- <a href="{{ route('home') }}" class="block px-4 py-2 text-sm text-gray-700">Dashboard</a> --}}
                    </div>
                </div>
                @if ($mailchimpData)
                    <p class="text-gray-50">API Key: {{ substr($mailchimpData->api_key, 0, 3) }}
                        **********-{{ $mailchimpData->prefix }}</p>
                    <p class="text-gray-50">Prefix: {{ $mailchimpData->prefix }}</p>
                @endif



            </ul>
        </div>
        <div>
            @if (isset($errorMessage))
                <div class="text-red-400 bg-red-100 p-3 ">
                    {{ $errorMessage }}
                </div>
            @endif
        </div>
        <div class="px-10">
            <div style="display:none" x-show="isOpen === 'contacts' " style="display: none" class="py-5 space-y-5">
                <h1 class="font-medium text-2xl tracking-widest">Chat contact info</h1>
                <div class=" text-sm font-medium text-gray-900  border border-gray-200 rounded-lg   bg-white ">
                    @foreach ($usersContacts as $key => $contact)
                        <div class=" ">
                            <div
                                class=" w-full px-4 py-2 border-b border-gray-200  shadow hover:bg-gray-100 hover:text-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-700 focus:text-purple-700 flex justify-between items-center">
                                <span>
                                    <i style="display:none" x-show="openContact !== @js($contact->id)"
                                        class='bx bx-check-circle'></i>
                                    <i style="display:none" x-show="openContact === @js($contact->id)"
                                        class='bx bxs-check-circle text-green-500'></i>
                                    {{ $contact->title }}
                                </span>
                                <div class="flex items-center space-x-5" x-data="{ listId: null }">
                                    @if (!$errorMessage)
                                        <select id="countries" x-model="listId"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                            style="-webkit-appearance: none; -moz-appearance: none; -webkit-appearance: none; appearance: none;"
                                            >
                                            <option disabled selected>Select Audience</option>
                                            @if ($mailLists)
                                                @foreach ($mailLists->lists as $list)
                                                    <option value="{{ $list->id }}">{{ $list->name }}</option>
                                                @endforeach
                                            @else
                                                <option>empty</option>
                                            @endif
                                        </select>


                                        <form action="{{ route('home.subscribe') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="contentId" value="{{ $contact->id }}">
                                            @if ($mailLists)
                                                <input type="hidden" name="listId"
                                                    :value="listId ?? '{{ $mailLists->lists[0]->id }}'">
                                            @endif
                                            {{-- <input type="text" value="{{ null ?? $mailLists->lists[0]->id }}"> --}}
                                            @if ($contact->users_contact_info )
                                                
                                            <x-main-button type="submit" class="text-gray-50">Subscribe</x-main-button>
                                            @endif

                                        </form>
                                    @endif
                                    {{-- <x-main-button type="submit" class="text-gray-50"
                                        onclick="document.getElementById({{ $contact->id }}).submit()">Subscribe</x-main-button> --}}

                                    {{-- form1 --}}

                                    <i style="display:none" x-show="openContact !== @js($contact->id)"
                                        class='bx bxs-chevron-down text-xl cursor-pointer'
                                        @click="openContact = @js($contact->id)"></i>
                                    <i style="display:none" x-show="openContact === @js($contact->id)"
                                        class='bx bxs-chevron-up c text-xl cursor-pointer'
                                        @click="openContact = null"></i>
                                </div>
                            </div>
                        </div>

                        @forelse ($contact->users_contact_info ?? [] as $key =>  $users_contact_info)
                            <div style="display:none" x-show="openContact === @js($contact->id)"
                                class="py-0.5  mt-1 text-sm bg-purple-50 px-4 hover:bg-purple-300 text-gray-900 flex justify-between transition duration-300 ease-out delay-100">
                                <p>
                                    {{ $loop->iteration }}. <span
                                        id="{{ $key }}">{{ $users_contact_info }}</span></p>

                                <button class="text-gray-600 hover:text-gray-700"
                                    onclick="toCopy(document.getElementById('{{ $key }}'))"> <i
                                        class="bx bx-copy"></i> <span>copy</span></button>
                            </div>
                        @empty
                            <p style="display:none" x-show="openContact === @js($contact->id)"
                                class="text-center text-md p-2">No Contact Yet
                            </p>
                        @endforelse
                    @endforeach
                </div>
            </div>
         
        </div>


        <script>
            function toCopy(copyDiv) {
                var range = document.createRange();
                range.selectNode(copyDiv);
                window.getSelection().removeAllRanges();
                window.getSelection().addRange(range);
                document.execCommand("copy");
            }
        </script>
    </div>
</x-app-layout>
