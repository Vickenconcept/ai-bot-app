<div class="mx-8 space-y-5 " x-data="{ openEditor: false }">
    <div
        class="sticky top-16 py-3 boder-b flex justify-between bg-white  border-b font-bold tracking-wider text-xl capitalize">
        <a href="{{ URL::previous() }}" class=" ">
            <i class='bx bxs-chevron-left'></i>
            {{ $document->title }}
        </a>
        <div>
            <button @click="openEditor=false" x-show="openEditor"
                class="bg-gray-50 text-purple-700 shadow-inner border items-center  px-3  text-center  rounded hover:shadow-lg transition duration-300 py-2 text-xs font-semibold   disabled:opacity-25  ease-in-out"
                style="display: none">cancle</button>
            <x-main-button @click="openEditor=true" x-show="!openEditor" class="text-gray-50">Edit</x-main-button>
            <form wire:submit="deleteDocument" class="inline">

                <x-main-button type="submit" class="bg-red-500 text-gray-50">Delete</x-main-button>
            </form>
        </div>
    </div>
    <div x-show="!openEditor" class="overflow-hidden  break-words rounded-lg border-y py-2">
        {!! $document->content !!}
    </div>

    <div x-show="openEditor" class="mx-auto  lg:w-[60%]" style="display: none">
        <form wire:submit="documentSaveChanges" class="space-y-2">
            <div wire:ignore>
                <textarea id="content" name="content" class="w-full" rows="2" wire:model.live="content">
                </textarea>
            </div>
            <button type="submit" wire:loading.attr="disabled" onclick=" reloadPage()"
                {{ !is_null($content) && !empty($content) ? '' : 'disabled' }}
                class="inline-flex items-center bg-purple-600 text-gray-50 py-2.5 px-4 text-xs shadow font-medium text-center  rounded hover:shadow-lg">
                save
            </button>

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
    </script>
</div>
