<x-app-layout>
    <!-- heading -->
    <x-title>
        Plan details
    </x-title>

    <div class="px-20">
        <!-- edit/delete buttons -->
        <div class="flex justify-end space-x-2 py-2">
            <a href="{{ route('plan.edit', $travel_plan->id) }}">
                <x-primary-button>edit</x-primary-button>
            </a>
            <form action="" method="post">
                <x-danger-button>delete</x-danger-button>
            </form>
        </div>
        
        <!-- plan details -->
        <div class="pt-3 flex items-center">
            <a href=""><i class="fa-solid fa-circle-user text-gray-500 text-5xl"></i></a>
            <h4 class="text-xl ps-2">{{ $travel_plan->user->name }}</h4>
            <h4 class="text-xl ms-auto px-2">{{ $travel_plan->country->name }}</h4>
            <i class="fi fi-{{ $travel_plan->country->code }} text-3xl"></i>
        </div>

        <div class="px-8 pt-4">
            <!-- plan style -->
            <div class="flex pt-5 items-center font-bold">
                <h4 class="text-xl py-1">Style&nbsp;:</h4>
                @foreach ( $all_styles as $style)
                    <p class="text-xl ms-2 px-2 bg-gray-300 rounded">{{ $style->style_name }}</p>                
                @endforeach
            </div>

            <!-- plan name -->
            <div class="flex pt-5 items-center font-bold">
                <h4 class="text-xl">Plan&nbsp;:</h4>
                <p class="text-xl ms-2">{{$travel_plan->title}}</p>
            </div>

            <!-- description -->
            <div class="flex pt-5 items-start">
                <h4 class="text-xl font-bold">description&nbsp;:</h4>
                <p class="text-base ms-2">{{ $travel_plan->description }}</p>
            </div>

            <!-- date -->
            <div class="flex pt-5 items-center">
                <h4 class="text-xl font-bold">date&nbsp;:</h4>
                <p class="text-base ms-2">{{ $travel_plan->start_date }}</p>
                <p class="text-base mx-2">-</p>
                <p class="text-base">{{ $travel_plan->end_date }}</p>
            </div>

            <!-- max participants -->
            <div class="flex pt-1 items-center">
                <h4 class="text-xl font-bold">Max&nbsp;:</h4>
                <p class="text-base ms-2">{{ $travel_plan->max_participants }}</p>
                <p class="text-base ms-1">people</p>
            </div>

            <!-- buttons -->
                <!-- before interacted -->
                <div class="flex justify-end space-x-5 py-2 items-center">
                    <form action="" method="post">
                        <button type="submit"><i class="fa-regular fa-heart text-red-500 text-3xl"></i><span class="text-2xl ms-1">like</span><span class="text-md ms-1">23</span></button>
                    </form>
                    <form action="" method="post">
                        <button type="submit"><i class="fa-regular fa-flag text-green-500 text-3xl"></i><span class="text-2xl ms-1">interested</span><span class="text-md ms-1">4</span></button>
                    </form>
                    <form action="" method="post">
                        <x-secondary-button>JOIN</x-secondary-button>
                    </form>
                </div>

            </div>
            
            <!-- participants chat -->
            <div class="border-4 border-sky-300 box-border rounded-md mt-3 overflow-y-auto">
                <h4 class="text-xl text-sky-500 text-center font-bold">participants chat</h4>
                <!-- others' message -->
                <div class="flex items-start gap-2 p-3">
                    <!-- icon -->
                    <a href=""><i class="fa-solid fa-circle-user text-gray-500 text-3xl"></i></a>
                    <div>
                        <!-- username -->
                        <span class="text-xs text-gray-500">Risa</span>

                        <!-- chat content/time -->
                        <div class="flex items-end gap-1">
                            <div class="bg-gray-200 rounded-2xl rounded-tl-none p-3">
                                Hi, I'm Risa. I'm from Japan.
                            </div>
                            <div class="text-xs text-gray-500">21:48&nbsp;01/09/2025</div>
                        </div>
                    </div>
                </div>

                <!-- own message -->
                <div class="flex justify-end items-start gap-2 p-3">
                    <div class="flex items-end justify-end gap-1">
                        <!-- time/content -->
                        <span class="text-xs text-gray-500">21:53&nbsp;01/09/2025</span>
                        <div class="bg-orange-500 text-white rounded-2xl rounded-tr-none p-3 text-sm">
                            Thanks for joining. I'm Rin. glad to see a new member.
                        </div>
                    </div>
                </div>

                <div class="border-t border-gray-300 p-3 flex gap-2">
                    <form action="" method="post" class="w-full flex gap-2">
                        <input type="text" name="" id="" placeholder="message..." class="flex-1 min-w-0 border border-gray-300 rounded-full px-4 py-2 focus:outline-none focus:ring-2">
                        <!-- <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-full flex-shrink-0">send</button> -->
                        <button type="submit" class="flex-shrink-0"><img src="\images\send-message.png" alt=""></button>
                    </form>
                </div>
            </div>

            <!-- comment -->
            <div class="border border-black box-border rounded-md my-5 overflow-y-auto">
                <h4 class="text-xl font-bold ms-3">comments</h4>
                <div class="flex items-center space-x-3 p-4">
                    <!-- icon -->
                    <a href=""><i class="fa-solid fa-circle-user text-gray-500 text-3xl"></i></a>

                    <div class="flex flex-col justify-center">
                        <!-- name/time -->
                        <div class="flex items-center space-x-2">
                            <span class="font-semibold">John Doe</span>
                            <span class="text-sm text-gray-500">1h ago</span>
                        </div>

                        <!-- comment content -->
                        <p class="text-gray-700">
                            my first comment
                        </p>
                    </div>

                </div>

                <div class="flex items-center space-x-3 p-4 border-b">
                    <!-- icon -->
                    <a href=""><i class="fa-solid fa-circle-user text-gray-500 text-3xl"></i></a>

                    <div class="flex flex-col justify-center">
                        <!-- name/time -->
                        <div class="flex items-center space-x-2">
                            <span class="font-semibold">Sensei</span>
                            <span class="text-sm text-gray-500">5 mins ago</span>
                        </div>

                        <!-- comment content -->
                        <p class="text-gray-700">
                            I'm Kenjiro Tsuda.
                        </p>
                    </div>
                </div>

                <div class="border-t border-gray-300 p-3 flex gap-2">
                    <form action="" method="post" class="w-full flex gap-2">
                        <input type="text" name="" id="" placeholder="message..." class="flex-1 min-w-0 border border-gray-300 rounded-full px-4 py-2 focus:outline-none focus:ring-2">
                        <!-- <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-full flex-shrink-0">send</button> -->
                        <button type="submit" class="flex-shrink-0"><img src="\images\send-message.png" alt=""></button>
                    </form>
                </div>

            </div>

    </div>
</x-app-layout>