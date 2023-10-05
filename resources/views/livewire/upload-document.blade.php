<div class="" x-data="{ activeSection: '', hideSection: true }">
    @if ($errors->any())
        <div class="bg-red-50 text-red-300  p-3 mb-5 border border-red-300 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

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

    <div x-show.transition.in="activeSection === 'section1'" class="card-animate space-y-4" style="display: none">
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

                <button type="submit" wire:loading.attr="disabled" onclick=" reloadPage()"
                    @click=" hideSection = true, activeSection = '' "
                    {{ !is_null($content) && !empty($content) && (!is_null($title) && !empty($title)) ? '' : 'disabled' }}
                    class="inline-flex items-center bg-blue-600 text-gray-50 py-2.5 px-4 text-xs shadow font-medium text-center  rounded hover:shadow-lg">
                    Create
                </button>
            </div>
        </form>
    </div>
    {{--  --}}
    <div x-show="activeSection === 'section2'" class="card-animate space-y-4" style="display: none">
        <button class="font-semibold" @click=" hideSection = true, activeSection = '' "><i
                class='bx bx-chevron-left'></i> Options</button>
        <form class="space-y-3" wire:submit="saveUploadedDocument">
            {{-- <x-dropzone /> --}}
            {{-- <input type="file" name="" id="" wire:model.live="file" class="cursor-pointer"> --}}
            <label for="name" class="font-senibold block">Upload PDF or DOCX<span
                    class="text-red-400 ml-1">*</span></label>
            <div class="flex items-center justify-center w-full">
                <label for="dropzone-file"
                    class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50  hover:bg-gray-100 ">
                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                        <svg class="w-8 h-8 mb-4 text-gray-500 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 20 16">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                        </svg>
                        <p class="mb-2 text-sm text-gray-500 "><span class="font-semibold">Click to
                                upload</span> or drag and drop</p>
                        <p class="text-xs text-gray-500 ">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                    </div>
                    <input id="dropzone-file" type="file" class="hidden" wire:model.live="file" />
                </label>
            </div>

            <button type="submit" onclick=" reloadPage()" @click=" hideSection = true, activeSection = '' "
                {{ !is_null($file) && !empty($file) && in_array($file->extension(), ['pdf', 'docx']) ? '' : 'disabled' }}
                class="inline-flex items-center bg-blue-600 text-gray-50 py-2.5 px-4 text-xs shadow font-medium text-center  rounded hover:shadow-lg">
                Create
            </button>
        </form>

    </div>
    {{--  --}}
    <div x-show="activeSection === 'section3'" class="card-animate space-y-4" style="display: none">
        <button class="font-semibold" @click=" hideSection = true, activeSection = '' "><i
                class='bx bx-chevron-left'></i> Options</button>
        <label for="name" class="font-senibold block">Paste Web Url<span class="text-red-400 ml-1">*</span></label>
        <input id="name" type="text" wire:model.live="webUrl" placeholder="https://www.example.com" class="form-control"
            autocomplete="false">
        {{-- @error('webUrl') <span class="error">{{ $message }}</span> @enderror --}}

        <div>
            <button type="submit" wire:click="scrapeWebsite" onclick=" reloadPage()"
                @click=" hideSection = true, activeSection = '' "
                {{ !is_null($webUrl) && !empty($webUrl) && filter_var($webUrl, FILTER_VALIDATE_URL) ? '' : 'disabled' }}
                class="inline-flex items-center bg-blue-600 text-gray-50 py-2.5 px-4 text-xs shadow font-medium text-center  rounded hover:shadow-lg">
                Create
            </button>
        </div>

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
            }, 6000);
        }
    </script>
</div>
