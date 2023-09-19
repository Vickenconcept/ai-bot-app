<div class="mx-8 space-y-5 " x-data="{ openEditor: false }">
    <div class="sticky top-16 py-3 boder-b flex justify-between bg-white  border-b font-bold tracking-wider text-xl capitalize">
            <a href="{{ URL::previous() }}" class=" ">
                <i class='bx bxs-chevron-left'></i>
                {{ $document->title }}
            </a>
        <div>
            <x-main-button @click="openEditor=false" x-show="openEditor" class="bg-gray-100" style="display: none">cancle</x-main-button>
            <x-main-button @click="openEditor=true" x-show="!openEditor" class="text-gray-50">Edit</x-main-button>
            <form wire:submit="deleteDocument" class="inline">

                <x-main-button type="submit" class="bg-red-500 text-gray-50">Delete</x-main-button>
            </form>
        </div>
    </div>
    <div x-show="!openEditor"  class="overflow-hidden  break-words rounded-lg border-y py-2">
        {!! $document->content !!} 
    </div>

    <div x-show="openEditor" class="mx-auto  lg:w-[60%]" style="display: none">
        <form wire:submit="documentSaveChanges" class="space-y-2">
            <div wire:ignore>
                <textarea id="content" name="content" class="w-full" rows="2" wire:model.live="content">
                </textarea>
            </div>
            <button type="submit" wire:loading.attr="disabled" onclick=" reloadPage()"  
            {{ (!is_null($content) && !empty($content))  ? '' : 'disabled' }}
            class="inline-flex items-center bg-blue-600 text-gray-50 py-2.5 px-4 text-xs shadow font-medium text-center  rounded hover:shadow-lg">
            Create
        </button>

        </form>
      
       

    </div>

    <script>
        jQuery.noConflict();
        (function($) {
            // Your jQuery code here
            jQuery(document).ready(function() {
                // Your Summernote initialization code here
                $('#content').summernote({
                    height: 300,
                    minHeight: null,
                    maxHeight: null,
                    focus: true,
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
