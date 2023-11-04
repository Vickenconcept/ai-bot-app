<div class="mt-20 pb-10">
    <div class="w-full px-5 flex flex-col justify-between" x-data="{ isOpen: null, openLast: false, contactType: true }">
        <div class="flex flex-col mt-5">
            @foreach ($history as $key => $response)
                @if ($loop->iteration <= $secondToLastIndex)
                    <div class="flex justify-start mb-4">
                        <span class="h-8 w-8 rounded-full flex justify-center items-center font-bold  bg-green-100 "><i
                                class='bx bxs-bot text-2xl '></i></span>
                        <div
                            class="ml-2 py-3 px-4 bg-purple-200 text-purple-900 rounded-br-3xl rounded-tl-3xl rounded-tr-3xl ">
                            {{ $response }}
                        </div>
                    </div>
                    @if ($loop->iteration == $secondToLastIndex)
                        <div class="flex space-x-5 pl-10" x-show="contactType">
                            <x-main-button class="text-gray-50"
                                @click="isOpen = 'email', contactType=false">email</x-main-button>
                            <x-main-button class="text-gray-50" @click="isOpen ='number', contactType=false">phone
                                number</x-main-button>
                        </div>
                        <div class="pl-10">
                            <form wire:submit>
                                <div class="py-5 flex items-center" x-show=" isOpen === 'email'">
                                    <input class="form-control flex-grow" wire:model.live="email" type="email"
                                        placeholder="Enter your email here" />
                                    <div class="flex-initial ml-1">

                                        @if ($email !== '' && $email !== null) 
                                        <x-main-button class="text-gray-50 "
                                            @click="openLast = true, isOpen=null"
                                            wire:click="subscribe">Submit</x-main-button>
                                            @endif
                                    </div>
                                </div>
                            </form>
                            <form wire:submit>
                                <div class="py-5 flex items-center" x-show=" isOpen === 'number'">
                                    <input class="form-control" wire:model.live="phoneNumber" type="number"
                                        placeholder="Enter your number here" />
                                    <div class="flex-initial ml-1">
                                        @if ($phoneNumber !== '' && $phoneNumber !== null) 
                                        <x-main-button class="text-gray-50 " @click="openLast = true, isOpen=null"
                                            wire:click="subscribe">Submit</x-main-button>
                                            @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    @endif
                @endif
            @endforeach
            <div class="flex justify-end mb-4" x-show="openLast">
                <div class="mr-2 py-3 px-4 bg-purple-800 text-purple-50 rounded-bl-3xl rounded-tl-3xl rounded-tr-3xl ">
                    {{ $email }} {{ $phoneNumber }}
                </div>
                <span class="h-8 w-8 rounded-full flex justify-center items-center font-bold  bg-green-100  ">
                    ME
                </span>
            </div>
            <div class="flex justify-start mb-4" x-show="openLast">
                <span class="h-8 w-8 rounded-full flex justify-center items-center font-bold  bg-green-100 "><i
                        class='bx bxs-bot text-2xl '></i></span>
                <div class="ml-2 py-3 px-4 bg-purple-200 text-purple-900 rounded-br-3xl rounded-tl-3xl rounded-tr-3xl ">
                    {{ $chatData[$secondToLastIndex] }}
                </div>
            </div>
        </div>
    </div>
    {{-- <x-main-button wire:click="nextResponse">Next Response</x-main-button> --}}

    <script>
        setInterval(() => {
            @this.dispatch('nextResponse');
            document.body.scrollTop = document.body.scrollHeight;
            document.documentElement.scrollTop = document.documentElement.scrollHeight;
        }, 3000);
    </script>
</div>
