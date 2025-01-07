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

    <div id="hiddenText" class=" flex items-center my-3 hidden">
        <span> <i class='bx bx-loader-alt animate-spin text-purple-600 text-3xl'></i></span>
        <span>Learning...</span>

    </div>
    <div wire:loading class="card-animate flex justify-start   ">

        <div role="status">
            <svg aria-hidden="true" class="w-8 h-8 mr-2 text-gray-200 animate-spin fill-purple-600" viewBox="0 0 100 101"
                fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                    fill="currentColor" />
                <path
                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                    fill="currentFill" />
            </svg>
            <span>Learning...</span>
            <span class="sr-only">Loading...</span>
        </div>
    </div>

    <div style="display: none" id="isLoading">

        <div role="status">
            <svg aria-hidden="true" class="w-8 h-8 mr-2 text-gray-200 animate-spin fill-purple-600" viewBox="0 0 100 101"
                fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                    fill="currentColor" />
                <path
                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                    fill="currentFill" />
            </svg>
            <span>Learning...</span>
            <span class="sr-only">Loading...</span>
        </div>
    </div>



    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 card-animate" x-show="hideSection" style="display: none">
        <div class="rounded-2xl cursor-pointer hover:bg-purple-100 border border-purple-300  bg-gray-50  p-5 text-center space-y-8"
            @click="activeSection = 'section1'; hideSection=false">
            <h1><i class='bx bx-pen text-2xl bg-purple-200 px-3 py-2 rounded-md'></i></h1>
            <div>
                <h1 class="font-bold tracking-wider">Write</h1>
                <p class="text-ray-400 text-sm">Write or copy paste your document</p>
            </div>
        </div>
        <div class="rounded-2xl cursor-pointer hover:bg-purple-100 border border-purple-300  bg-gray-50  p-5 text-center space-y-8"
            @click="activeSection = 'section2'; hideSection=false">
            <h1><i class='bx bx-upload text-2xl bg-purple-200 px-3 py-2 rounded-md'></i></h1>
            <div>
                <h1 class="font-bold tracking-wider">Upload</h1>
                <p class="text-ray-400 text-sm">PDF or Word Doc</p>
                
            </div>
        </div>
        <div class="rounded-2xl cursor-pointer hover:bg-purple-100 border border-purple-300  bg-gray-50  p-5 text-center space-y-8"
            @click="activeSection = 'section3'; hideSection=false">
            <h1><i class='bx bx-link-alt text-2xl bg-purple-200 px-3 py-2 rounded-md'></i></h1>
            <div>
                <h1 class="font-bold tracking-wider">Import Website</h1>
                <p class="text-ray-400 text-sm">Web pages with text content</p>
            </div>
        </div>
    </div>

    <div x-show.transition.in="activeSection === 'section1'" class="card-animate space-y-4" style="display: none">
        <button class="font-semibold" @click=" hideSection = true, activeSection = '' ">
            <i class='bx bx-left-arrow-alt mr-2 rounded-full bg-purple-200 p-2'></i> Back to options</button>

        <form>
            <div class="space-y-2 ">
                <label for="name" class="font-senibold">Document Title<span
                        class="text-red-400 ml-1">*</span></label>
                <input id="name" type="text" wire:model.defer="title" placeholder="" class="form-control"
                    autocomplete="false">
                <label for="description" class="font-senibold">Content <span class="text-red-400 ml-1">*</span></label>
                <div wire:ignore>
                    <textarea id="content" name="content" class="w-full" rows="2" wire:model.defer="content">
                        
                    </textarea>
                </div>

                <button type="submit" wire:loading.attr="disabled" wire:click="saveWrittenDocument"
                    @click=" hideSection = true, activeSection = '' " {{-- {{ !is_null($content) && !empty($content) && (!is_null($title) && !empty($title)) ? '' : 'disabled' }} --}}
                    class="inline-flex items-center bg-purple-600 text-gray-50 py-2.5 px-4 text-xs shadow font-medium text-center  rounded hover:shadow-lg">
                    Create
                </button>
            </div>
        </form>
    </div>
    {{--  --}}
    <div x-show="activeSection === 'section2'" class="card-animate space-y-4" style="display: none">
        <button class="font-semibold" @click=" hideSection = true, activeSection = '' ">
            <i class='bx bx-left-arrow-alt mr-2 rounded-full bg-purple-200 p-2'></i> Back to options</button>


        <form class="space-y-3" method="post" action="{{ route('uploadfile') }}" enctype="multipart/form-data"
            id="fileUploadForm">
            @csrf
            <label for="file" class="font-senibold block">Upload PDF or DOCX<span
                    class="text-red-400 ml-1">*</span></label>

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
                    <p class="text-xs text-gray-500 ">DOC, PDF</p>
                    <p class="text-ray-400 text-sm font-medium text-red-700">Max of 10mb</p>
                </div>
                <input id="dropzone-file" type="file" class="hidden" name="file" />
            </label>
            <input type="hidden" id="" name="content_id" value="{{ $contentTitle->id }}">
            <button type="submit" @click=" hideSection = true, activeSection = '' " {{-- {{ !is_null($file) && !empty($file) && in_array($file->extension(), ['pdf', 'docx']) ? '' : 'disabled' }} --}}
                class="inline-flex items-center bg-purple-600 text-gray-50 py-2.5 px-4 text-xs shadow font-medium text-center  rounded hover:shadow-lg">
                Create
            </button>
        </form>

        {{-- <form class="space-y-3" wire:submit="saveUploadedDocument" enctype="multipart/form-data">

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
                    <input id="dropzone-file" type="file" class="hidden" wire:model.defer="file" />
                </label>
            </div>

            <button type="submit" @click=" hideSection = true, activeSection = '' "
                class="inline-flex items-center bg-purple-600 text-gray-50 py-2.5 px-4 text-xs shadow font-medium text-center  rounded hover:shadow-lg">
                Create
            </button>
        </form> --}}

    </div>
    {{--  --}}
    <div x-show="activeSection === 'section3'" class="card-animate space-y-4" style="display: none">
        <button class="font-semibold" @click=" hideSection = true, activeSection = '' ">
            <i class='bx bx-left-arrow-alt mr-2 rounded-full bg-purple-200 p-2'></i> Back to options</button>
        <label for="name" class="font-senibold block">Paste Web Url<span
                class="text-red-400 ml-1">*</span></label>
        <input id="name" type="text" wire:model.defer="webUrl" placeholder="https://www.example.com"
            class="form-control" autocomplete="false">
        {{-- @error('webUrl') <span class="error">{{ $message }}</span> @enderror --}}

        <div>
            <button type="submit" wire:click="scrapeWebsite" @click=" hideSection = true, activeSection = '' "
                {{-- {{ !is_null($webUrl) && !empty($webUrl) && filter_var($webUrl, FILTER_VALIDATE_URL) ? '' : 'disabled' }} --}}
                class="inline-flex items-center bg-purple-600 text-gray-50 py-2.5 px-4 text-xs shadow font-medium text-center  rounded hover:shadow-lg">
                Create
            </button>
        </div>

    </div>

    <div>
        <div class=" bg-gray-200 rounded-full my-3  w-full shadow-inner">
            <div class=" bg-green-700  text-center p-0.5 text-xs font-semibold rounded-full text-gray-50 "
                id="btn">
                {{ $totalDocumentCount }}
            </div>
        </div>
        <div class="flex justify-between">
            <h1>Documents you have currently stored out of your allowed quota.</h1>
            <h1>{{ $totalDocumentCount }}/{{ $documentLimit }}</h1>

        </div>
    </div>
    <script>
        const total = @json($totalDocumentCount);
        const btn = document.getElementById('btn');
        btn.style.width = `${total}%`
    </script>


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
            // setTimeout(function() {
            //     window.location.reload();
            // }, 6000);
            // console.log('done');
        }

        window.addEventListener('beforeunload', function(event) {
            var hiddenText = document.getElementById('hiddenText');
            hiddenText.classList.remove('hidden');
        });
    </script>


    <script>
        document.getElementById('fileUploadForm').addEventListener('submit', function(e) {
            e.preventDefault(); // Prevent form from submitting traditionally

            let isLoading = document.getElementById('isLoading');

            isLoading.style.display = 'block';
            const formData = new FormData(this);

            fetch("{{ route('uploadfile') }}", {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    isLoading.style.display = 'none';
                    if (data.success) {

                        Toastify({
                            text: 'File uploaded and processed successfully!',
                            duration: 3000,
                            backgroundColor: "linear-gradient(to right, #56ab2f, #a8e063)",
                        }).showToast();

                        setTimeout(function() {
                            window.location.reload();
                        }, 2000);
                    } else {
                        // Handle error response
                        Toastify({
                            text: 'An error occurred during file upload.',
                            duration: 4000,
                            backgroundColor: "linear-gradient(to right, #FF5F6D, #FFC371)",
                        }).showToast();

                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    isLoading.style.display = 'none';
                    Toastify({
                            text: 'An error occurred during file upload.',
                            duration: 4000,
                            backgroundColor: "linear-gradient(to right, #FF5F6D, #FFC371)",
                    }).showToast();
                });
        });
    </script>
</div>
