<div x-data="{ loaded: true }">
    <div x-show="loaded" x-init="window.addEventListener('DOMContentLoaded', () => { setTimeout(() => loaded = false, 1000) })"
        class="fixed left-0 top-0 z-999999 flex h-screen w-screen items-center justify-center bg-purple-100"
        style="z-index: 1000">
        <div class="  rounded-full  ">
            {{-- <img src="{{ asset('images/moving_ball.gif') }}"  alt="" style="opacity: 0.8;"> --}}
            <p class="text-xl animate-pulse text-purple-900 font-semibold">Loading...</p>

        </div>
        <div
        class="loadingio-eclipse">
          <div class="ldio-rpinwye8j0b">
            <div>
            </div>
          </div>
        </div>
    </div>
</div>
