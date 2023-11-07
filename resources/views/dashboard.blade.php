<x-app-layout>
    <div class="text-gray-700" x-data="{ isOpen: 'contacts', openContact: null }">
        <hr>
        <div class="bg-purple-700 px-10 ">
            <ul class=" flex py-2 space-x-5">
                <a href="#" @click="isOpen = 'contacts'">
                    <li class="py-0.5 px-2 rounded-md text-sm bg-purple-50 hover:bg-purple-300 text-gray-900">Users
                        contacts
                    </li>
                </a>
                {{-- <a href="#" @click="isOpen = 'support'">
                    <li class="py-0.5 px-2 rounded-md text-sm bg-purple-50 hover:bg-purple-300 text-gray-900">Support
                    </li>
                </a> --}}

            </ul>
        </div>
        <div class="px-10">
            <div style="display:none" x-show="isOpen === 'contacts' " style="display: none" class="py-5 space-y-5">
                <h1 class="font-medium text-2xl tracking-widest">Chat contact info</h1>
                <div class=" text-sm font-medium text-gray-900  border border-gray-200 rounded-lg   bg-white ">
                    @foreach ($usersContacts as $key => $contact)
                        <div class=" ">
                            <div 
                                class=" w-full px-4 py-2 border-b border-gray-200 cursor-pointer shadow hover:bg-gray-100 hover:text-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-700 focus:text-purple-700 flex justify-between">
                                <span>
                                    <i style="display:none" x-show="openContact !== @js($contact->id)" class='bx bx-check-circle'></i>
                                    <i style="display:none" x-show="openContact === @js($contact->id)"
                                        class='bx bxs-check-circle text-green-500'></i>
                                    {{ $contact->title }}
                                </span>
                                <i style="display:none" x-show="openContact !== @js($contact->id)" class='bx bxs-chevron-down cursor-pointer'
                                    @click="openContact = @js($contact->id)"></i>
                                <i style="display:none" x-show="openContact === @js($contact->id)" class='bx bxs-chevron-up cursor-pointer'
                                    @click="openContact = null"></i>
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
                            <p style="display:none" x-show="openContact === @js($contact->id)" class="text-center text-md p-2">No Contact Yet
                            </p>
                        @endforelse
                    @endforeach
                </div>
            </div>
            <div style="display:none" x-show="isOpen === 'support' " style="display: none">
                SUPPORT
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
