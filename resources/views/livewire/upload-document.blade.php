<div class="" x-data="{ activeSection: '', hideSection: true }">

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 card-animate" x-show="hideSection" style="display: none">
        <div class="rounded-md cursor-pointer hover:bg-blue-100 border border-blue-300  bg-blue-50  p-3"
            @click="activeSection = 'section1'; hideSection = false">
            <h1><i class='bx bx-pen text-2xl'></i></h1>
            <div>
                <h1 class="font-semibold tracking-wider">Write</h1>
                <p class="text-ray-400 text-sm">Write or copy paste your document</p>
            </div>
        </div>
        <div class="rounded-md cursor-pointer hover:bg-red-100 border border-red-300  bg-red-50  p-3"
            @click="activeSection = 'section2'; hideSection = false">
            <h1><i class='bx bx-upload text-2xl'></i></h1>
            <div>
                <h1 class="font-semibold tracking-wider">Upload</h1>
                <p class="text-ray-400 text-sm">PDF or Word Doc</p>
            </div>
        </div>
        <div class="rounded-md cursor-pointer hover:bg-yellow-100 border border-yellow-300  bg-yellow-50  p-3"
            @click="activeSection = 'section3'; hideSection = false">
            <h1><i class='bx bx-link-alt text-2xl'></i></h1>
            <div>
                <h1 class="font-semibold tracking-wider">Import Website</h1>
                <p class="text-ray-400 text-sm">Web pages with text content</p>
            </div>
        </div>
    </div>

    <div x-show.transition.in="activeSection === 'section1'" class="card-animate" style="display: none">
        <button class="font-semibold" @click=" hideSection = true, activeSection = '' "><i
                class='bx bx-chevron-left'></i> Options</button>

        <form wire:submit="saveWrittenDocument">
            <div class="space-y-2 ">
                <label for="name" class="font-senibold">Document Title<span
                        class="text-red-400 ml-1">*</span></label>
                <input id="name" type="text" wire:model.live="title" placeholder="" class="form-control"
                    autocomplete="false">
                <label for="description" class="font-senibold">Content <span class="text-red-400 ml-1">*</span></label>
                <div wire:ignore>
                    <textarea id="content" name="content" class="w-full" rows="2" wire:model.live="content">
                        
                    </textarea>
                </div>

                <button type="submit" wire:loading.attr="disabled" onclick=" reloadPage()"  @click=" hideSection = true, activeSection = '' "
                    {{ (!is_null($content) && !empty($content)) && (!is_null($title) && !empty($title)) ? '' : 'disabled' }}
                    class="inline-flex items-center bg-blue-600 text-gray-50 py-2.5 px-4 text-xs shadow font-medium text-center  rounded hover:shadow-lg">
                    Create
                </button>
            </div>
        </form>
    </div>
    {{--  --}}
    <div x-show="activeSection === 'section2'" class="card-animate" style="display: none">
        <button class="font-semibold" @click=" hideSection = true, activeSection = '' "><i
                class='bx bx-chevron-left'></i> Options</button>
        <form class="space-y-3" wire:submit="saveUploadedDocument">
            <x-dropzone />
            <input type="file" name="" id="" wire:model.live="file">

            <button wire:click="saveUploadedDocument"
                class="inline-flex items-center bg-blue-600 text-gray-50 py-2.5 px-4 text-xs shadow font-medium text-center  rounded hover:shadow-lg">
                Create
            </button>
        </form>

    </div>
    {{--  --}}
    <div x-show="activeSection === 'section3'" class="card-animate" style="display: none">
        <button class="font-semibold" @click=" hideSection = true, activeSection = '' "><i
                class='bx bx-chevron-left'></i> Options</button>
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


        function reloadPage() {
            setTimeout(function() {
                window.location.reload();
            }, 3000);
        }
    </script>
</div>
