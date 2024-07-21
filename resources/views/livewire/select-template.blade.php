<div x-data="{ template: null, templateGallary: true }" class="space-y-5">
    <x-select-avatar />
    <h1 class="font-bold text-2xl ">Select your Template</h1>
    <hr class="mb-10">
    <div class="grid sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-2" x-show="templateGallary">
        @foreach ($templates as $template)
            <div class="max-w-sm rounded overflow-hidden shadow-lg cursor-pointer"
                @click="$dispatch('selectedTemplate', { id: @js($template[0])}),template = @js($template[0]), templateGallary = false">
                <img class="w-full" src="{{ $template[1] }}" alt="Sunset in the mountains">
                <div class="px-6 py-4">
                    <div class=" text-xl mb-2 capitalize">{{ $template[2] }}</div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="space-y-4">
        <div>
            <button @click="templateGallary = true, template = null"
                class="hover:underline font-semibold flex items-center"><i class='bx bx-chevron-left '></i>
                Back</button>
        </div>
        <div x-show="template === 'template 1'">
            <h1 class="font-bold tracking-wide text-2xl text-center">Trained Bot Converstion <span
                    class="text-sm italic">(default)</span></h1>
            <livewire:customize-view :guestChat="$guestChat" />
            <div class="grid grid-col-2 my-5">
                <button wire:click="customizeTemplateTwo" @click="templateGallary = true, template = null"
            class="btn-primary ">submit</button>
            </div>
        </div>
        <div x-show="template === 'template 2'" class=" w-[60%] mx-auto space-y-5">
            <h1 class="font-bold tracking-wide text-2xl text-center">Display product images in slides</h1>
            <p>Paste image urls here </p>
            <div class="  grid lg:grid-cols-2 gap-5">

                @foreach ($inputs as $index => $value)
                    <div>
                        <input type="text" wire:model="imageUrl.{{ $index }}" class="form-control"
                            placeholder="enter image url">

                        <input type="number" name="" id="" class="w-40 rounded border p-1 mt-2"
                            wire:model="productPrice.{{ $index }}" placeholder=" enter price">
                        <input type="text" name="" id="" class="w-40 rounded border p-1 mt-2"
                            wire:model="productName.{{ $index }}" placeholder=" product name">
                    </div>
                @endforeach
            </div>

            <button wire:click="customizeTemplateTwo" @click="templateGallary = true, template = null"
                class="btn-primary">submit</button>

        </div>
        <div x-show="template === 'template 3'" class="space-y-5">
            <h1 class="font-bold tracking-wide text-2xl text-center">Audio Conversation</h1>
            {{-- <x-select-avatar /> --}}


            <p>Add desired sentence sequence to get users contact detail, either email or phone number </p>
            <div class="text-red-400 bg-red-50 border border-red-400 p-3 rounded  ">
                <span>Note: Your CTA follows the second to the last sentence you input </span>

            </div>

            <div class="  grid lg:grid-cols-2 gap-5">

                @foreach ($tempThreeDefaultData as $index => $value)
                    <div>
                        <input type="text" wire:model="tempThree.{{ $index }}" class="form-control"
                            placeholder="{{ $value }}">
                    </div>
                @endforeach
            </div>
            <x-main-button class="text-purple-50" wire:click="addToTemplateThree">+ Add </x-main-button>
            <button wire:click="customizeTemplateThree" @click="templateGallary = true, template = null"
                class="btn-primary">submit</button>
        </div>
        <div x-show="template === 'template 4'" class="space-y-5">
            <h1 class="font-bold tracking-wide text-2xl text-center">Chat with Images</h1>
            <p>Add desired sentence sequence to get users contact detail. You can add image url to your chat template
            </p>
            <div class="text-red-400 bg-red-50 border border-red-400 p-3 rounded  ">
                <span>Note: Your CTA follows the second to the last sentence you input </span>

            </div>

            <div class="  grid lg:grid-cols-2 gap-5">

                @foreach ($tempFourDefaultData as $index => $value)
                    <div>
                        <input type="text" wire:model="tempFour.{{ $index }}" class="form-control"
                            placeholder="{{ $value }}">
                    </div>
                @endforeach
            </div>
            <x-main-button class="text-purple-50" wire:click="addToTemplateFour">+ Add </x-main-button>
            <button wire:click="customizeTemplateFour" @click="templateGallary = true, template = null"
                class="btn-primary">submit</button>

        </div>
        <div x-show="template === 'template 5'" class="space-y-5">
            <h1 class="font-bold tracking-wide text-2xl text-center">Chat with videos</h1>
            <p>Add desired sentence sequence to get users contact detail. You can add video url to your chat template
            </p>
            <div class="text-red-400 bg-red-50 border border-red-400 p-3 rounded  ">
                <span>Note: Your CTA follows the second to the last sentence you input </span>

            </div>

            <div class="  grid lg:grid-cols-2 gap-5">

                @foreach ($tempFiveDefaultData as $index => $value)
                    <div>
                        <input type="text" wire:model="tempFive.{{ $index }}" class="form-control"
                            placeholder="{{ $value }}">
                    </div>
                @endforeach
            </div>
            <x-main-button class="text-purple-50" wire:click="addToTemplateFive">+ Add </x-main-button>
            <button wire:click="customizeTemplateFive" @click="templateGallary = true, template = null"
                class="btn-primary">submit</button>
        </div>
        <div x-show="template === 'template 6'" class="space-y-5">

            <h1 class="font-bold tracking-wide text-2xl text-center">Enter your desired Keywords and response </p>
                <div class="  grid lg:grid-cols-2 gap-5  mt-5">

                    @foreach ($tempSixDefaultData as $index => $value)
                        <div class=" font-normal">
                            <label for=""></label>
                            <input type="text" wire:model="question.{{ $index }}" class="form-control"
                                placeholder="Your keyword..">
                            <input type="text" wire:model="answer.{{ $index }}" class="form-control  mt-2"
                                placeholder="Your response..">
                        </div>
                    @endforeach
                </div>


                <x-main-button class="text-purple-50" wire:click="addToTemplateSix">+ Add </x-main-button>
                <button wire:click="customizeTemplateSix" @click="templateGallary = true, template = null"
                    class="btn-primary mt-2">submit</button>
        </div>

        <div x-show="template === 'template 7'" class="space-y-5">
            <div class="py-10   flex flex-col  justify-center items-center  space-y-6 bg-purple-50 ">
                <h1 class="font-bold text-2xl tracking-wide">Book An Appointment</h1>
                <form class="space-y-3 bg-purple-200 px-5 py-10 rounded-lg w-full mx-auto lg:w-[40%]">
                    <div>
                        <label for="name" class="text-xs font-semibold">Enter Your Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Your name">
                    </div>
                    <div>
                        <label for="email" class="text-xs font-semibold">Enter Your Email</label>
                        <input type="text" name="email" class="form-control" placeholder="Your Email">
                    </div>
                    <div>
                        <div class="flex items-center space-x-4">
                            <div class="w-1/2 pr-4 flex-wrap">
                                <label for="" class="text-xs font-semibold">Start Date</label>
                                <input type="datetime-local" name="start_date" id="start_date"
                                    class="w-full block rounded-md border-0" placeholder="Start Date">
                            </div>
                            <div class="w-1/2 pr-4 flex-wrap">
                                <label for="" class="text-xs font-semibold">End Date</label>
                                <input type="datetime-local" name="end_date" id="end_date"
                                    class="w-full block rounded-md border-0" placeholder="End Date">
                            </div>
                        </div>
                    </div>
                    <div class="w-full">
                        <textarea name="" id="" rows="3" class="w-full rounded-lg border-0 p-3">
                            your comment...
                </textarea>
                    </div>

                    <button type="button" @click="templateGallary = true, template = null"
                        class="btn-primary flex items-center"><i class="bx bx-send mr-2"></i>Select</button>
                </form>
            </div>
        </div>
    </div>


</div>
