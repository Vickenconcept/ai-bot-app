    <div class="space-y-8 " x-data="{ isCheckedAll: false, isCheckedOne: [], openModal: false, body: '' }">


        
        <div>
            <h1 class="font-bold tracking-wider">Create Documents</h1>
            <p class="text-ray-400 text-sm">You can create a document using one of the options below</p>
        </div>
        <livewire:upload-document :$body :$contentTitle />
        <div class="flex flex-col lg:flex-row space-y-3 lg:justify-between">
            <div>
                <h1 class="font-bold tracking-wider">Stored Documents</h1>
                <p class="text-ray-400 text-sm">These are all uploaded documents that Bots can learn from.</p>
            </div>



            <div class="flex flex-col lg:flex-row space-y-3 lg:space-y-0 lg:justify-between lg:space-x-3  card-animate">
                <div x-show="isCheckedAll || isCheckedOne != ''">
                    <x-dropdown>
                        <x-slot name="trigger">
                            <x-main-button class="text-gray-50 ">Action <i
                                    class='bx bx-dots-vertical-rounded'></i></x-main-button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link class="cursor-pointer px-4 py-2 " onclick="deleteSelectedItems()">
                                Delete
                            </x-dropdown-link>
                        </x-slot>
                    </x-dropdown>
                </div>

                <form class=" " action="{{ route('contents.show', ['content' => $contentTitle->id]) }}"
                    method="GET">
                    @csrf
                    <div>
                        <input id="text" name="query" type="text" placeholder="Search documents"
                            class="form-control">
                    </div>
                </form>
            </div>

        </div>

        <div class="relative  shadow-md sm:rounded-lg overflow-x-auto refreshed card-animate" id="reloadableSection">
            <table class="w-full text-sm text-left text-gray-500 ">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50  ">
                    <tr>
                        <th scope="col" class="px-6 py-3 ">
                            <input type="checkbox" name="" id="checkAll" x-model="isCheckedAll">
                            <span>name</span>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Updated on
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Created on
                        </th>
                        {{-- <th scope="col" class="px-6 py-3">
                            <span class="sr-only">Edit</span>
                        </th> --}}
                        <th class=" "></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($body as $body)
                        <tr class="bg-white border-b  hover:bg-gray-50 ">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap capitalize flex space-x-1">
                                <input type="checkbox" name="" value="{{ $body->id }}" id=""
                                    x-model="isCheckedOne" class="checkBoxClass">
                                <a href="{{ route('documents.show', ['document' => $body->id]) }}"
                                    class="hover:text-blue-900">{{ $body->title }}</a>
                            </th>
                            <td class="px-6 py-4 capitalize">
                                <span
                                    class=" rounded-full bg-green-50  text-green-800 px-3 py-1 text-sm">{{ $body->status }}</span>
                            </td>
                            <td class="px-6 py-4 capitalize">{{ $body->updated_at }}</td>
                            <td class="px-6 py-4 capitalize">{{ $body->created_at }}</td>
                            <td class="px-6 py-4 capitalize  ">

                                <button type="submit" @click="openModal = true ; body = @js($body)"><i
                                        class='bx bxs-edit-alt'></i></button>
                                {{-- <form action="{{ route('documents.destroy', ['document' => $body->id]) }}"
                                    method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">::</button>
                                </form> --}}
                            </td>
                        </tr>

                    @empty

                        <td class="px-6 py-4 capitalize text-center" colspan="6">No data found</td>
                    @endforelse

                </tbody>

            </table>
        </div>
        <div class="fixed items-center justify-center  flex top-0 left-0 mx-auto w-full h-full bg-gray-600 bg-opacity-20 z-10 transition duration-1000 ease-in-out"
            x-show="openModal" style="display: none;">
            <div @click.away="openModal = false"
                class="bg-white w-[70%] lg:w-[40%] shadow-inner  border rounded-lg overflow-auto  pb-6 px-5 transition-all relative duration-700">
                <div class="space-y-5 pt-5 ">
                    <span class="text-xl font-bold">Rename Document</span>
                    <form action="{{ route('documents.updateData') }}" method="post">
                        @csrf
                        <div class="space-y-5">
                            <input type="hidden" :value="body.id" name="id">
                            <input id="body.id" type="text" name="title" placeholder="Search body"
                                :value="body.title" class="form-control" autocomplete="false">
                            <div class="space-x-3">
                                <x-main-button type="submit" class="text-gray-50">Update</x-main-button>
                                <button
                                    class="bg-gray-50 px-2 py-1 rounded hover:shadow text-purple-700 shadow-inner border"
                                    @click="openModal = false">Cancle</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>



            <script>
                var deleteSelectedItems;

                jQuery.noConflict();
                (function($) {

                    $(document).ready(function() {
                        $('#checkAll').click(function() {
                            $('.checkBoxClass').prop('checked', this.checked);
                        });

                        $('.checkBoxClass').click(function() {
                            $('#checkAll').prop('checked', $('.checkBoxClass:checked').length === $(
                                '.checkBoxClass').length);
                        });

                    });

                    deleteSelectedItems = function() {
                        var selectedItems = $('.checkBoxClass:checked').map(function() {
                            return this.value;
                        }).get();


                        $.ajax({
                            url: '/documents/' + selectedItems.join(','),
                            type: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                console.log('Items deleted successfully');
                                // Do something after successful deletion, if needed
                                window.location.href = '/contents/' + @json($contentTitle->id);
                            },
                            error: function(error) {
                                console.error('Error deleting items:', error);
                            }
                        });
                        // setTimeout(function() {
                        //     window.location.reload();
                        // }, 500);
                    };

                })(jQuery);


                // document.addEventListener('livewire:initialized', function() {
                //     @this.on('confirmDelete', (itemId) => {

                //         if (confirm('Are you sure you want to delete item ' + itemId.itemId + '?')) {
                //             @this.dispatch('deleteItem', itemId.itemId);
                //         }
                //     });
                // });

                document.addEventListener('livewire:initialized', () => {
                    @this.on('refreshComponent', (event) => {
                        console.log(event);
                        window.location.reload();
                        
                    });
                });
            </script>
        </div>
