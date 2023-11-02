<div class="h-screen">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>



    <div class=" -z-10 h-full flex justify-center items-center   md:w-[80%]  lg:w-[50%] mx-auto">
        <div id="myCarousel" class="carousel slide border  rounded-xl  overflow-hidden  w-full bg-white"
            data-ride="carousel" style=" height:500px; ">
            <!-- Indicators -->
            {{-- <ol class="carousel-indicators">
                @foreach ($conversationTitle->image_link as $key => $data)
                    <li data-target="#myCarousel" data-slide-to="{{ $key }}"
                        @if ($key === 0) class="active" @endif></li>
                @endforeach --}}
            </ol>

            <div class="carousel-inner">
                @if (isset($conversationTitle->image_link))

                    @foreach ($conversationTitle->image_link as $key => $data)
                        <div :class="['item', 'h']" @if ($key === 0) class="active" @endif>
                            <div class="w-full mx-auto  block overflow-hidden" style=" height:370px; ">
                                <img src="{{ $data['url'] }}" alt="product image" class="object-cover h-full "
                                    style="width:100%;">
                            </div>
                            <div class=" text-center  mt-5 block ">
                                <p class="text-[18px]  font-bold capitalize tracking-widest">{{ $data['name'] }}</p>
                                <p class="text-[15px]  ">${{ $data['price'] }}</p>
                                <button class="text-white bg-purple-700 rounded-lg py-2 px-4 ">Add to cart</button>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
                <span class="sr-only">Next</span>
            </a>



        </div>
    </div>

</div>
