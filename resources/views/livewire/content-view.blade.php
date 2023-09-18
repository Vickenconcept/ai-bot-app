<div class="space-y-8">

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
            <div><x-main-button class="text-gray-50 " onclick="deleteSelectedItems()">Action :</x-main-button></div>
            <form class=" " action="#" method="POST">
                <div>
                    <input id="text" name="sort" type="text" placeholder="Search documents"
                        class="form-control">
                </div>
            </form>
        </div>

    </div>

    <div wire:target="refreshComponent" class="card-animate flex justify-end  {{ $hideComponent }}">

        <div role="status">
            <svg aria-hidden="true" class="w-8 h-8 mr-2 text-gray-200 animate-spin fill-blue-600" viewBox="0 0 100 101"
                fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                    fill="currentColor" />
                <path
                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                    fill="currentFill" />
            </svg>
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <div class="relative  shadow-md sm:rounded-lg overflow-x-auto refreshed card-animate" id="reloadableSection" >
        <table class="w-full text-sm text-left text-gray-500 ">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50  ">
                <tr>
                    <th scope="col" class="px-6 py-3 ">
                        <input type="checkbox" name="" id="checkAll"> <span>name</span>
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
                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">Edit</span>
                    </th>
                    <th class=" md:hidden"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($body as $body)
                    <tr class="bg-white border-b  hover:bg-gray-50 ">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap capitalize flex space-x-1">
                            <input type="checkbox" name="" value="{{ $body->id }}" id=""
                                class="checkBoxClass">
                            <a href="#" class="hover:text-blue-900">{{ $body->title }}</a>
                        </th>
                        <td class="px-6 py-4 capitalize">
                            <span
                                class=" rounded-full bg-green-50  text-green-800 px-3 py-1 text-sm">{{ $body->status }}</span>
                        </td>
                        <td class="px-6 py-4 capitalize">{{ $body->updated_at }}</td>
                        <td class="px-6 py-4 capitalize">{{ $body->created_at }}</td>
                        <td class="px-6 py-4 capitalize  md:hidden">
                            <form action="{{ route('documents.destroy', ['document' => $body->id]) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button>::</button>
                            </form>
                        </td>
                    </tr>
                @endforeach

            </tbody>

        </table>
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
                    },
                    error: function(error) {
                        console.error('Error deleting items:', error);
                    }
                });
                setTimeout(function() {
                    window.location.reload();
                }, 500);
            };

        })(jQuery);


        // document.addEventListener('livewire:initialized', function() {
        //     @this.on('confirmDelete', (itemId) => {

        //         if (confirm('Are you sure you want to delete item ' + itemId.itemId + '?')) {
        //             @this.dispatch('deleteItem', itemId.itemId);
        //         }
        //     });
        // });
    </script>
</div>