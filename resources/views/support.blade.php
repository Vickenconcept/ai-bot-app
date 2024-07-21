<x-app-layout>

    {{-- <div class=" h-screen w-full flex justify-center items-center p-20 ">
        <div class="bg-white  p-5 sm:p-10 text-center w-[80%] mx-auto space-y-5 text-gray-700">

            <div class="grid grid-cols-1 lg:grid-cols-5">
                <div></div>
                <div class="rounded shadow-md p-5 col-span-3 space-y-5">
                    <p class="font-semi-bold text-xl my-3">Thank you for your patronage.</p>
                    <p class="text-sm">Indeed you made a great decision because ConvergeAI works and we are here to help
                        you
                        get an outstanding result too like other early adopters.</p>
                    <p class="text-sm mt-3">Note: If you need any support
                        kindly reach out to us here </p>

                    <a href="mailto:support@supremewebcustomercare.freshdesk.com?subject=Support Request"
                        class="text-sm text-blue-600 mb-5">support@supremewebcustomercare.freshdesk.com</a>
                </div>
            </div>
        </div>
    </div> --}}

    <div class="" x-data="{ isOpen: 'tutorial' }">
        <hr>
        <div class="bg-purple-700 px-10 ">
            <ul class=" flex py-2 space-x-5">
                <a href="#" @click="isOpen = 'tutorial'">
                    <li class="py-0.5 px-2 rounded-md text-sm bg-purple-50 hover:bg-purple-300 text-gray-900">Tutorial
                    </li>
                </a>
                <a href="#" @click="isOpen = 'support'">
                    <li class="py-0.5 px-2 rounded-md text-sm bg-purple-50 hover:bg-purple-300 text-gray-900">Support
                    </li>
                </a>

            </ul>

        </div>
        <div class="px-10">
            <div x-show="isOpen === 'tutorial' " style="display: none">
                <h1 class="text-center font-bold text-3xl uppercase">tutorial</h1>

                <div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 px-10 py-10">
                        <x-card title="1.Account View" thumbnail="{{ asset('image/chatbot.png') }}"
                            url="https://vimeo.com/956187139?share=copy" />

                        <x-card title="2. Bot Creation" thumbnail="{{ asset('image/chatbot.png') }}"
                            url="https://vimeo.com/956191161?share=copy" />

                        <x-card title="3. Conversation View" thumbnail=" {{ asset('image/chatbot.png') }}"
                            url=" https://vimeo.com/956339736?share=copy" />

                        <x-card title="4. Knowledge Base" thumbnail="{{ asset('image/chatbot.png') }}"
                            url="https://vimeo.com/956344594?share=copy" />

                        <x-card title="5. ESP Configuration" thumbnail="{{ asset('image/chatbot.png') }}"
                            url="https://vimeo.com/956352235?share=copy" />

                        <x-card title="6. Profile" thumbnail="{{ asset('image/chatbot.png') }}"
                            url="https://vimeo.com/956394600?share=copy" />

                        <x-card title="7. Reseller" thumbnail="{{ asset('image/chatbot.png') }}"
                            url="https://vimeo.com/956396634?share=copy" />

                        <x-card title="8. Templates Explained" thumbnail="{{ asset('image/chatbot.png') }}"
                            url="https://vimeo.com/956398831?share=copy" />

                    </div>
                </div>
            </div>




            <div x-show="isOpen === 'support' " style="display: none">

                <div class="bg-white  p-5 sm:p-10 text-center w-full lg:w-[80%] h-96 mx-auto space-y-5 text-gray-700">

                    <div class="grid grid-cols-1 lg:grid-cols-5">
                        <div></div>
                        <div class="rounded shadow-md p-5 col-span-3 space-y-5">
                            <p class="font-bold text-xl my-3 tracking-wide">Thank you for your patronage.</p>
                            <p class="text-sm">Indeed you made a great decision because ConvergeAI works and we are
                                here to help
                                you
                                get an outstanding result too like other early adopters.</p>
                            <p class="text-sm mt-3">Note: If you need any support
                                kindly reach out to us here </p>

                            <a href="mailto:support@supremewebcustomercare.freshdesk.com?subject=Support Request"
                                class="text-sm text-blue-600 mb-5">support@supremewebcustomercare.freshdesk.com</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
