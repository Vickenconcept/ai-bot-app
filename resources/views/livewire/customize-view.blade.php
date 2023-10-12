<div class="space-y-8" wire:poll="selectedCustom">
    {{-- Do your work, then step back. --}}
    <button wire:click="selectedCustom">click me</button>
    <div>
        <h1 class=" font-bold text-xl capitalize">customize</h1>

        <p>Customize the appearance of your chat widget. Changes can take a few minutes to appear on your site.</p>
    </div>

    <div class=" text-red-400 bg-red-50 rounded-lg border border-red-400 px-5 py-3 space-y-2">
        <h3 class=" font-bold text-md"> Preview Only</h3>
        <p class="text-sm">This is for your preview only, you need Basic or higher subscription plan to apply these
            customizations.</p>
        <button class="  bg-red-100 rounded-lg border border-red-200 px-4 py-1 text-sm">subscribe</button>
    </div>

    <section class="grid grid-cols-1 lg:grid-cols-2 space-y-8">
        <div class="space-y-8 ">
            <div class="p-5 border rounded-lg space-y-5 bg-white">
                <h1 class=" font-bold text-md capitalize">Header</h1>
                <h1 class=" text-md capitalize">Layout</h1>
                <div class="grid grid-cols-2 space-x-4" x-data="{ selected: null }">
                    <input type="radio" name="personality" id="center" value="center" hidden
                        wire:model.live="selected">
                    <label for="center"
                        class="font-semibold capitalize bg-white border-2 rounded-lg p-6 cursor-pointer relative "
                        @click=" selected = 'center'" {{-- wire:click="selectedCustom" --}}
                        :class="{
                            'bg-blue-200  border-blue-500': selected === 'center',
                            '': selected !== 'center'
                        }">
                        Center
                        <i class='bx bx-check-circle absolute text-white right-2 top-2 font-semibold'
                            :class="{
                                'text-blue-500': selected === 'center',
                                '': selected !== 'center'
                            }"></i>
                    </label>
                    <input type="radio" name="personality" id="left" value="left" hidden
                        wire:model.live="selected">
                    <label for="left"
                        class="font-semibold upperase bg-white border-2 rounded-lg p-6 cursor-pointer relative"
                        @click=" selected = 'left'"
                        :class="{
                            'bg-blue-200  border-blue-500': selected === 'left',
                            '': selected !== 'left'
                        }">Left
                        <i class='bx bx-check-circle absolute text-white right-2 top-2 font-semibold '
                            :class="{
                                'text-blue-500': selected === 'left',
                                '': selected !== 'left'
                            }"></i>

                    </label>
                </div>
                <div>
                    <h1 class=" text-md capitalize mb-2">Logo</h1>
                    <label for="logo" class="cursor-pointer rounded-full  ">
                        <i
                            class='bx bx-upload text-3xl  bg-gray-200 rounded-full  px-2 py-1'></i>
                        <input type="file" name="logo" id="logo" hidden>
                    </label>
                </div>

                <div>
                    <h1 class=" text-md capitalize">Background Color</h1>
                    <div class=" flex">
                        <div class="border-2 rounded-lg  pr-2 flex space-x-2">
                            <input type="color" name="color" id="color" class=" "
                                wire:model.live="navColor">
                            <span class="font-semibold">{{ $navColor ?? '#0000' }}</span>
                        </div>
                    </div>
                </div>
                <div>
                    <h1 class=" text-md capitalize">Text Color</h1>
                    <div class=" flex">
                        <div class="border-2 rounded-lg  pr-2 flex space-x-2">
                            <input type="color" name="color" id="color" class=" "
                                wire:model.live="textColor">
                            <span class="font-semibold">{{ $textColor ?? '#0000' }}</span>
                        </div>
                    </div>
                </div>
                <div>
                    <label for="title" class="input-label">Title</label>
                    <div class="mt-2">
                        <input id="title" name="title" type="title" autocomplete="title"
                            wire:model.live="title" class="form-control">

                    </div>
                </div>
                <div>
                    <label for="subtitle" class="input-label">Subtitle</label>
                    <div class="mt-2">
                        <input id="subtitle" name="subtitle" type="subtitle" autocomplete="subtitle"
                            wire:model.live="subTitle" class="form-control">

                    </div>
                </div>
            </div>
            {{--  --}}
            <div class="p-5 border rounded-lg space-y-5 bg-white">
                <h1 class=" font-bold text-md capitalize">Launcher</h1>
                <div>
                    <h1 class=" text-md capitalize">Size</h1>
                    <select id="role" name="role"
                    wire:model.live="size"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                           
                              <option value="10px 14px">Small</option>
                              <option value="12px 16px">Medium</option>
                              <option value="15px 20px">Large</option>
                        </select>
                </div>

                <div>
                    <h1 class=" text-md capitalize">Screen Position</h1>
                    <select id="role" name="role"
                    wire:model.live="position"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                              <option value="left">Left</option>
                              <option value="right">Right</option>
                        </select>
                </div>

                <div>
                    <h1 class=" text-md capitalize">Background Color</h1>
                    <div class=" flex">
                        <div class="border-2 rounded-lg  pr-2 flex space-x-2">
                            <input type="color" name="color" id="color" class=" "
                                wire:model.live="launcherColor">
                            <span class="font-semibold">{{ $launcherColor ?? '#0000' }}</span>
                        </div>
                    </div>
                </div>

                <h1 class=" text-md capitalize">Icon</h1>
                <div class="flex flex-wrap space-x-4" x-data="{ launcherIcon: null }">
                    <input type="radio" name="icons" id="bxs-message-rounded" value="bxs-message-rounded" hidden
                        wire:model.live="launcherIcon">
                    <label for="bxs-message-rounded"
                        class=" cursor-pointer relative "
                        @click=" launcherIcon = 'bxs-message-rounded'" {{-- wire:click="launcherIconCustom" --}}
                        >
                        <i
                        class='bx bxs-message-rounded text-3xl  bg-gray-200 rounded-full  px-2 py-1'
                        :class="{
                            ' border border-blue-500': launcherIcon === 'bxs-message-rounded',
                            '': launcherIcon !== 'bxs-message-rounded'
                        }"></i>
                        <i class='bx bx-check-circle absolute text-white right-2 top-2 font-semibold'
                            :class="{
                                'text-blue-500': launcherIcon === 'bxs-message-rounded',
                                '': launcherIcon !== 'bxs-message-rounded'
                            }"></i>
                    </label>

                    <input type="radio" name="icons" id="bxs-chat" value="bxs-chat" hidden
                        wire:model.live="launcherIcon">
                    <label for="bxs-chat"
                        class=" cursor-pointer relative"
                        @click=" launcherIcon = 'bxs-chat'"
                        >
                        <i
                        class='bx bxs-chat text-3xl  bg-gray-200 rounded-full  px-2 py-1'
                        :class="{
                            'border border-blue-500': launcherIcon === 'bxs-chat',
                            '': launcherIcon !== 'bxs-chat'
                        }"></i>
                        <i class='bx bx-check-circle absolute text-white right-2 top-2 font-semibold '
                            :class="{
                                'text-blue-500': launcherIcon === 'bxs-chat',
                                '': launcherIcon !== 'bxs-chat'
                            }"></i>

                    </label>

                    <input type="radio" name="icons" id="bxs-help-circle" value="bxs-help-circle" hidden
                        wire:model.live="launcherIcon">
                    <label for="bxs-help-circle"
                        class=" cursor-pointer relative"
                        @click=" launcherIcon = 'bxs-help-circle'"
                       >
                        <i
                        class='bx bxs-help-circle text-3xl  bg-gray-200 rounded-full  px-2 py-1'
                        :class="{
                            'border border-blue-500': launcherIcon === 'bxs-help-circle',
                            '': launcherIcon !== 'bxs-help-circle'
                        }"></i>
                        <i class='bx bx-check-circle absolute text-white right-2 top-2 font-semibold '
                            :class="{
                                'text-blue-500': launcherIcon === 'bxs-help-circle',
                                '': launcherIcon !== 'bxs-help-circle'
                            }"></i>

                    </label>

                    <input type="radio" name="icons" id="bxs-bot" value="bxs-bot" hidden
                        wire:model.live="launcherIcon">
                    <label for="bxs-bot"
                        class=" cursor-pointer relative"
                        @click=" launcherIcon = 'bxs-bot'"
                       >
                        <i
                        class='bx bxs-bot text-3xl  bg-gray-200 rounded-full  px-2 py-1'
                        :class="{
                            'border border-blue-500': launcherIcon === 'bxs-bot',
                            '': launcherIcon !== 'bxs-bot'
                        }"></i>
                        <i class='bx bx-check-circle absolute text-white right-2 top-2 font-semibold '
                            :class="{
                                'text-blue-500': launcherIcon === 'bxs-bot',
                                '': launcherIcon !== 'bxs-bot'
                            }"></i>

                    </label>

                    <input type="radio" name="icons" id="bx-bot" value="bx-bot" hidden
                        wire:model.live="launcherIcon">
                    <label for="bx-bot"
                        class=" cursor-pointer relative"
                        @click=" launcherIcon = 'bx-bot'"
                        >
                        <i
                        class='bx bx-bot text-3xl  bg-gray-200 rounded-full  px-2 py-1'
                        :class="{
                            'border border-blue-500': launcherIcon === 'bx-bot',
                            '': launcherIcon !== 'bx-bot'
                        }"></i>
                        <i class='bx bx-check-circle absolute text-white right-2 top-2 font-semibold '
                            :class="{
                                'text-blue-500': launcherIcon === 'bx-bot',
                                '': launcherIcon !== 'bx-bot'
                            }"></i>

                    </label>

                    <input type="radio" name="icons" id="bx-question-mark" value="bx-question-mark" hidden
                        wire:model.live="launcherIcon">
                    <label for="bx-question-mark"
                        class=" cursor-pointer relative"
                        @click=" launcherIcon = 'bx-question-mark'"
                        >
                        <i
                        class='bx bx-question-mark text-3xl  bg-gray-200 rounded-full  px-2 py-1'
                        :class="{
                            'border border-blue-500': launcherIcon === 'bx-question-mark',
                            '': launcherIcon !== 'bx-question-mark'
                        }"></i>
                        <i class='bx bx-check-circle absolute text-white right-2 top-2 font-semibold '
                            :class="{
                                'text-blue-500': launcherIcon === 'bx-question-mark',
                                '': launcherIcon !== 'bx-question-mark'
                            }"></i>

                    </label>

                    <input type="radio" name="icons" id="bx-x" value="bx-x" hidden
                        wire:model.live="launcherIcon">
                    <label for="bx-x"
                        class=" cursor-pointer relative"
                        @click=" launcherIcon = 'bx-x'"
                        >
                        <i
                        class='bx bx-x text-3xl  bg-gray-200 rounded-full  px-2 py-1'
                        :class="{
                            'border border-blue-500': launcherIcon === 'bx-x',
                            '': launcherIcon !== 'bx-x'
                        }"></i>
                        <i class='bx bx-check-circle absolute text-white right-2 top-2 font-semibold '
                            :class="{
                                'text-blue-500': launcherIcon === 'bx-x',
                                '': launcherIcon !== 'bx-x'
                            }"></i>

                    </label>

                </div>
                <div class="text-red-400 bg-red-50 border border-red-400 p-3 rounded  mt-5 w-full">
                    <span>After customizating your widget, remember to close window </span>
                </div>

            </div>


        </div>
        <div class=" lg:p-10 ">
            <div class="rounded-lg lg:sticky top-20 shadow" >
                <nav class=" px-5 py-3 rounded-t-lg flex  shadow"
                    style="background-color: {{ $navColor }}; color: {{ $textColor }}">
                    <img class="h-10 w-10 rounded-xl mr-2"
                                        src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                        alt="">
                    <div class="flex-grow">
                        <ul class="capitalize" style="text-align:  {{ $selected }}">
                            <li class="font-bold text-xl">{{ $title }}</li>
                            <li>{{ $subTitle }}</li>
                        </ul>
                    </div>

                </nav>
                <div class=" ">
                    <ul>
                        <div class="bg-white">
                            <div class="text-center text-xs ">
                                <span class="border-b">sep 10:59</span>
                            </div>
                            <div class="flex justify-between  py-10 w-[90%] md:w-[70%] mx-auto ">
                                <div class=" flex space-x-5">
                                    <img class="h-8 w-8 rounded-full"
                                        src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                        alt="">
                                    <li class="" id="">Hello</li>
                                </div>
                                <button class=" h-8 w-8  hidden">
                                    <i class='bx bx-copy-alt text-gray-400'></i>
                                </button>
                            </div>
                        </div>

                        <div class="bg-gray-100">
                            <div class="text-center text-xs ">
                                <span class="border-b">sep 10:59</span>
                            </div>
                            <div class="flex justify-between  py-10 w-[90%] md:w-[70%] mx-auto ">
                                <div class=" flex space-x-5">
                                    <img class="h-8 w-8 rounded-full"
                                        src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                        alt="">
                                    <li class="" id="">Welcom, what cn i do for you</li>
                                </div>
                                <button class="block h-8 w-8 ">
                                    <i class='bx bx-copy-alt text-gray-400'></i>
                                </button>
                            </div>
                        </div>
                    </ul>
                    <div class=" pt-10 pb-5 rounded-b-lg  bg-white">
                        <div class=" bg-white rounded-t-lg  w-[80%] shadow mx-auto">
                            <form id="messageForm">
                                @csrf
                                <textarea id="message" rows="2"
                                    class="w-full px-2 text-sm text-gray-900 bg-white border-0  focus:ring-transparent focus:outline-none resize-none"
                                    placeholder="Ask " wire:model.live="message"></textarea>
                            </form>
                            <div class="text-xl font-bold text-gray-400 text-right bg-gray-100">

                                <button disabled
                                    class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-gray-400 rounded-lg hover:text-gray-500">
                                    <i class='bx bxs-send text-2xl'></i>
                                </button>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
            <button class="btn" id="toggleIframe"
                style="
            position: fixed;
            bottom: 20px;
            {{ $position }}: 20px;
            color: white;
            background-color: {{ $launcherColor }};
            padding: {{ $size }};
            box-shadow: 5px 2px 5px #ccc;
            border-radius: 50px;">
                <i class='bx {{ $launcherIcon }} text-3xl'></i></button>

        </div>
    </section>
   
</div>
