<div>
    <div class="" >
        <ul class=" mb-32">
            @foreach ($body as $content)
                <div class="{{ $content->sender !== 'bot' ? 'bg-white' : 'bg-gray-100' }}">
                    <div class="flex justify-between  py-10 w-[90%] md:w-[70%] mx-auto ">
                        <div class=" flex space-x-5">
                            <img class="h-8 w-8 rounded-full"
                                src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                alt="">
                            <li class="" id="{{ $content->id }}">{{ $content->message }}</li>
                        </div>
                        <button onclick="toCopy(document.getElementById('{{ $content->id }}'))">
                            <i class='bx bx-copy-alt text-gray-400'></i>
                        </button>
                    </div>
                </div>
            @endforeach

           
        </ul>
    
        <div class=" w-[100%] md:w-[75%] bottom-5  fixed ">
            <div class=" w-full flex justify-center container">
                <div
                    class="w-[90%] md:w-[70%] mx-auto  border border-gray-200 rounded-lg bg-gray-50   shadow-md shadow-blue-200 ">
                    <div class="px-4 py-2 bg-white rounded-t-lg ">
    
                        <form wire:submit="saveMessage" id="messageForm" wire:ignore>
                            @csrf
    
                            <textarea id="message" rows="2"
                                class="w-full px-2 text-sm text-gray-900 bg-white border-0  focus:ring-transparent focus:outline-none resize-none"
                                placeholder="Ask Bot" wire:model.live="message"></textarea>
                        </form>
    
                    </div>
                    <div class="flex items-center justify-between px-2  border-t ">
                        <div class="flex pl-0 space-x-1 sm:pl-2">
                            <button type="button"
                                class="inline-flex justify-center items-center p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 ">
                                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 12 20">
                                    <path stroke="currentColor" stroke-linejoin="round" stroke-width="2"
                                        d="M1 6v8a5 5 0 1 0 10 0V4.5a3.5 3.5 0 1 0-7 0V13a2 2 0 0 0 4 0V6" />
                                </svg>
                                <span class="sr-only">Attach file</span>
                            </button>
                            <button type="button"
                                class="inline-flex justify-center items-center p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 ">
                                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 16 20">
                                    <path
                                        d="M8 0a7.992 7.992 0 0 0-6.583 12.535 1 1 0 0 0 .12.183l.12.146c.112.145.227.285.326.4l5.245 6.374a1 1 0 0 0 1.545-.003l5.092-6.205c.206-.222.4-.455.578-.7l.127-.155a.934.934 0 0 0 .122-.192A8.001 8.001 0 0 0 8 0Zm0 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z" />
                                </svg>
                                <span class="sr-only">Set location</span>
                            </button>
                            <button type="button"
                                class="inline-flex justify-center items-center p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 ">
                                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 20 18">
                                    <path
                                        d="M18 0H2a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm-5.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm4.376 10.481A1 1 0 0 1 16 15H4a1 1 0 0 1-.895-1.447l3.5-7A1 1 0 0 1 7.468 6a.965.965 0 0 1 .9.5l2.775 4.757 1.546-1.887a1 1 0 0 1 1.618.1l2.541 4a1 1 0 0 1 .028 1.011Z" />
                                </svg>
                                <span class="sr-only">Upload image</span>
                            </button>
                        </div>
    
                        <button wire:click="saveMessage"
                         {{ !is_null($message) && !empty($message) ? '' : 'disabled' }}
                            class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-gray-400 rounded-lg hover:text-gray-500">
                            <i class='bx bxs-send text-2xl'></i>
                        </button>
    
                    </div>
                </div>
            </div>
    
        </div>
    
        <script>
            // for coping text
            function toCopy(copyDiv) {
                var range = document.createRange();
                range.selectNode(copyDiv);
                window.getSelection().removeAllRanges();
                window.getSelection().addRange(range);
                document.execCommand("copy");
                // alert("copied!");
            }
    
            var html = ' ';
    
            // function refreshDiv() {
            //     const message = @json($conversationTitle->id)
    
            //     fetch(`/messages/${message}`)
            //         .then(response => response.json())
            //         .then(data => {
            //             const {
            //                 body,
            //                 conversation,
            //                 conversationTitle
            //             } = data;
            //             // console.log('Body:', body);
            //             body.forEach(message => {
            //                 const messageClass = message.sender === 'user' ? 'bg-white' : 'bg-gray-100';

            //                 console.log('Message:', message.message);
            //                 html = message.message
            //                 // document.getElementById('refreshDiv').innerHTML = `<li> message.message</li>`
            //             //     html += ` 
            //             //     <div class=" ${messageClass}">
            //             //  <div class="flex justify-between  py-10 w-[90%] md:w-[70%] mx-auto ">
            //             //  <div class=" flex space-x-5">
            //             //                             <img class="h-8 w-8 rounded-full"
            //             //                                 src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
            //             //                                 alt="">
            //             //                             <li class="" id="${ message.id }">${ message.message }</li>
            //             //                         </div>
            //             //                         <button onclick="toCopy(document.getElementById('${ message.id }'))">
            //             //                             <i class='bx bx-copy-alt text-gray-400'></i>
            //             //                         </button>
            //             //                         </div>
            //             //                         </div>`;
                                                
            //             });
                        
            //             document.getElementById('chat-box').innerHTML = html;
            //         })
            //         .then(data => {
            //             // Update the content of the div
            //             // document.getElementById('refreshDiv').innerHTML = data;
            //             // console.log(data);
            //         })
            //         .catch(error => console.error('Error:', error));
            // }
    
    
            // refreshDiv();
    
            // setInterval(refreshDiv, 1000);
        </script>
    </div>
    
</div>