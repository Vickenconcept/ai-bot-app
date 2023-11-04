<div x-data="{ template: null, templateGallary: true }" class="space-y-5">
    <h1 class="font-bold ">Select your Template</h1>
    <hr class="mb-10">
    <div class="grid sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-2" x-show="templateGallary">
        @foreach ($templates as $template)
            <div class="max-w-sm rounded overflow-hidden shadow-lg cursor-pointer"
                @click="$dispatch('selectedTemplate', { id: @js($template)}),template = @js($template), templateGallary = false">
                <img class="w-full"
                    src="https://media.istockphoto.com/id/1461083586/photo/half-folded-flyer-a4-booklet-mock-up-on-white-background.webp?b=1&s=170667a&w=0&k=20&c=fjw90yGrGs0XV_RcWtgRfbZ3mDOrZqnw_yzmXuSrRyQ="
                    alt="Sunset in the mountains">
                <div class="px-6 py-4">
                    <div class=" text-xl mb-2 capitalize">{{ $template }}</div>
                </div>
            </div>
        @endforeach
    </div>


    <div>
        <div x-show="template === 'template 1'">
            <livewire:customize-view :guestChat="$guestChat" />
        </div>
        <div x-show="template === 'template 2'" class=" w-[60%] mx-auto space-y-5">
            <p>Paste image urls here </p>
            <div class="  grid lg:grid-cols-2 gap-5">
               
                @foreach ($inputs as $index => $value)
                    {{-- <input wire:model="imageUrl.{{ $index }}" type="text"> --}}
                    <div>
                        <input type="text" wire:model="imageUrl.{{ $index }}" class="form-control"
                            placeholder="enter image url">
 
                            <input type="number" name="" id=""  class="w-40 rounded border p-1 mt-2" wire:model="productPrice.{{ $index }}" placeholder=" enter price">
                            <input type="text" name="" id=""  class="w-40 rounded border p-1 mt-2" wire:model="productName.{{ $index }}" placeholder=" product name">
                    </div>
                @endforeach
            </div>
            <button wire:click="customizeTemplateTwo" @click="templateGallary = true, template = null" class="btn-primary">submit</button>

        </div>
        <div x-show="template === 'template 3'" class="space-y-5">
            <p>Add desired sentence sequence to get users contact detail, either email or phone number </p>
            <div class="text-red-400 bg-red-50 border border-red-400 p-3 rounded  ">
                <span>Note: Your CTA follows the sentence in the second to the last input field </span>
                
            </div>

            <div class="  grid lg:grid-cols-2 gap-5">

                @foreach ($tempThreeDefaultData as $index => $value)
                    <div>
                        <input type="text" wire:model="tempThree.{{ $index }}" class="form-control"
                            placeholder="{{ $value }}" >
                    </div>
                @endforeach
            </div>
            <button wire:click="customizeTemplateThree" @click="templateGallary = true, template = null" class="btn-primary">submit</button>
        </div>
        <div x-show="template === 'template 4'"  class="space-y-5">
            <p>Add desired sentence sequence to get users contact detail, either email or phone number </p>
            <div class="text-red-400 bg-red-50 border border-red-400 p-3 rounded  ">
                <span>Note: Your CTA follows the sentence in the second to the last input field </span>
                
            </div>
            
            <div class="  grid lg:grid-cols-2 gap-5">

                @foreach ($tempFourDefaultData as $index => $value)
                <div>
                    <input type="text" wire:model="tempFour.{{ $index }}" class="form-control"
                    placeholder="{{ $value }}" >
                </div>
                @endforeach
            </div>
            <x-main-button class="text-purple-50" wire:click="addToTemplateFour">+ Add </x-main-button>
            <button wire:click="customizeTemplateFour" @click="templateGallary = true, template = null" class="btn-primary">submit</button>

        </div>
        <div x-show="template === 'template 5'">this is 5</div>
        <div x-show="template === 'template 6'">this is 6</div>
    </div>

   
</div>
