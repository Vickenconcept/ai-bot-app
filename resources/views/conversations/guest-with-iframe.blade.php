<x-guest-layout>
    <div class="bg-purple-50 h-screen flex items-center justify-center " >
        <div class="flex justify-center items-center  bg-white rounded-lg py-5 px-20">
            <img src="{{ asset('image/share-page-image.svg') }}" alt="" class="">
        </div>

    <div>
        <button class="btn" id="toggleIframe"
            style="
        position: fixed;
        bottom: 20px;
        right: 20px;
        color: white; border: 0px; cursor: pointer;
        background-color: purple ;
        padding: 15px 20px;
        box-shadow: 5px 2px 5px #ccc;
        border-radius: 50px;">
            <i class='bx bx-bot'></i>
        </button>

        <div class="" id="myIframe"
            style="position: fixed; bottom: 70px; right: 20px; display: none; align-items: center; border-radius: 10px;">
            <div style="flex: 1;">
                <video id="myVideo" autoplay loop muted style="max-width: 100%; height: auto;">
                    <source src="{{ $guestChat->avatar['image_url'] }}" type="video/mp4">
                </video>
            </div>
            <iframe id="myInnerIframe" src="{{ route('guests.show', ['guest' => $guestChat->uuid]) }}"
                style="box-shadow: 3px 3px 6px lightgray; border: 3px solid darkpurple; border-radius: 10px; flex: 1;"
                height="400"></iframe>
        </div>
    </div>

    <script>
        const body = document.querySelector('body');
        body.classList.add('top-window');
        const btns = document.querySelectorAll('.btn');
        btns.forEach(btn => {
            btn.style.display = 'block';
        });


        function initializeEmbed() {
            const container = document.getElementById('myIframe');
            const toggleIcon = document.getElementById('toggleIframe');

            toggleIcon.addEventListener('click', () => {
                container.style.display = (container.style.display === 'none' || container.style.display === '') ?
                    'flex' :
                    'none';
            });

            if (window === window.top) {
                document.body.classList.add('top-window');
            }
        }


        initializeEmbed();
    </script>
    </div>

</x-guest-layout>
