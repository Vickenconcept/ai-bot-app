<div class="mx-auto w-full lg:w-[80%] px-10 space-y-5 " x-data="{ openEditor: false }">
    <div class="sticky top-16 py-3  flex justify-between bg-purple-50   font-bold tracking-wider  capitalize">
        <a href="{{ URL::previous() }}" class=" ">
            <i class='bx bx-left-arrow-alt mr-2 rounded-full bg-purple-200 p-2'></i>
            Back
        </a>
        {{-- <div class="flex items-center space-x-2">
            <button @click="openEditor=false" x-show="openEditor"
                class="bg-gray-50 text-purple-700 shadow-inner border items-center  px-3  text-center  rounded hover:shadow-lg transition duration-300 py-2 text-xs font-semibold   disabled:opacity-25  ease-in-out"
                style="display: none">cancle</button>
            <x-main-button @click="openEditor=true" x-show="!openEditor" class="text-gray-50">Edit</x-main-button>
            <form wire:submit="deleteDocument" class="inline">

                <button type="submit" class="">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="red" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                    </svg>
                </button>
            </form>
        </div> --}}
    </div>
    <div>
        <div class="flex justify-between mb-5 items-cener">
            <h3 class="font-bold text-xl">Text</h3>
            <div class="flex items-center space-x-2">
                <x-main-button @click="openEditor=false" x-show="openEditor" class=" text-purple-50"
                    style="display: none"><i class="bx bx-x mr-1"></i>cancle</x-main-button>
                <x-main-button @click="openEditor=true" x-show="!openEditor" class="text-purple-50"><i
                        class="bx bx-edit mr-1"></i> Edit</x-main-button>
                <form wire:submit="deleteDocument" class="inline">

                    <button type="submit" class="">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="red" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>
        <div x-show="!openEditor" class="overflow-hidden  break-words rounded-lg border-y py-2">
            {!! $document->content !!}
        </div>
    </div>

    <div x-show="openEditor" class="mx-auto  " style="display: none">
        <form wire:submit="documentSaveChanges" class="space-y-2">
            <div wire:ignore>
                <textarea id="content" name="content" class="w-full" rows="2" wire:model.live="content">
                </textarea>
            </div>
            <div class="text-center">
                <button type="submit" wire:loading.attr="disabled" onclick=" reloadPage()" wire:click="documentSaveChanges"
                    {{ !is_null($content) && !empty($content) ? '' : 'disabled' }}
                    class="items-center  px-3  text-center  rounded bg-gradient-to-r from-violet-500 to-fuchsia-500 hover:bg-gradient-to-r hover:from-violet-600 hover:to-fuchsia-600 hover:shadow-lg transition duration-300 py-2 text-xs font-semibold   disabled:opacity-25  ease-in-out text-purple-50">
                    Save and Update
                </button>
            </div>
        </form>
    </div>

    <script>
        jQuery.noConflict();
        (function($) {
            // Your jQuery code here
            jQuery(document).ready(function() {

                $('#content').summernote({
                    height: 300,
                    toolbar: [
                        ['style', ['bold', 'italic', 'underline', 'clear']],
                        ['font', ['strikethrough', 'superscript', 'subscript']],
                        ['fontsize', ['fontsize']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['height', ['height']]
                    ],
                    focus: true,
                    minHeight: null,
                    maxHeight: null,
                    callbacks: {
                        onChange: function(contents, $editable) {
                            @this.set('content', contents);
                        },
                    }
                });

            });

        })(jQuery);

        function reloadPage() {
            // setTimeout(() => {
                console.log('hello');
                // location.reload();
            // }, 20000);
        }
    </script>
</div>
