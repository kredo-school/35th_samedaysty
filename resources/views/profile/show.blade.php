<x-app-layout>
    <!--header profile-->
    <div class="">
        <x-title name="header">
            {{ __('Profile') }}
        </x-title>
    </div>
    <!--avatar -->
    <div class=" items-start space-x-8 p-4">
        <div class="flex-none w-1/5">
            <div class="w-36 h-36 rounded-full bg-white flex items-center justify-center border border-orange-500">
                <i class="fa-solid fa-dragon text-gray-600 text-8xl"></i>
            </div>
        </div>
        <!--user info-->
        <div class="flex-1 w-4/5 flex flex-col justify-center">
            <h3 class="text-lg  sm:text-2xl md:text-3xl font-bold">{{ $user->name }}</h3>
            <!--count-->
            <div class="mt-4 flex space-x-6">
                <div class="flex items-center space-x-3">
                    <span class="text-gray-500">Posts</span>
                    <span class="font-bold">10{{--{{ $postsCount }}--}}</span>
                </div>
                <div class="flex items-center space-x-3">
                    <span class=" text-gray-500">Following</span>
                    <span class="font-bold">10{{--{{ $postsCount }}--}}</span>
                </div>
                <div class="flex items-center space-x-3>
                    <span class=" text-gray-500">Followers</span>
                    <span class="font-bold">20{{--{{ $followersCount }}--}}</span>
                </div>
            </div>
            <!--introduction-->
            <div class="mt-6">
                <h2 class="text-xl text-gray-500">introduction</h2>
                <p class="text-sm text-gray-500 mt-3 leading-relaxed break-words whitespace-pre-line">
                    {{ $user->bio ?? 'No introduction yet.' }}
                </p>
            </div>

            <div class="flex space-x-4 mt-4">
                @if(Auth::id() === $user->id)
                <!--only see own user-->
                <a href="{{ route('profile.edit',$user) }}"
                    class="px-4 py-2 text-white bg-zinc-500 rounded-md border-2 border-transparent hover:bg-white hover:text-zinc-500 hover:border-zinc-500 hover:border-2 transition">
                    Edit profile
                </a>
                <a href="#"
                    class="px-4 py-2 text-white bg-zinc-500 rounded-md border-2 border-transparent hover:bg-white hover:text-zinc-500 hover:border-zinc-500 hover:border-2 transition">
                    Share profile
                </a>
                <x-primary-button>
                    Change your status
                </x-primary-button>
                @else
                <!--other user-->
                <form method="POST" action="{{ route('follow',$user) }}">
                    @csrf
                    <x-primary-button>Follow</x-primary-button>
                </form>
                <a href="{{route('messages.create',$user) }}" class="px-4 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-600 transition">Message</a>
                @endif
            </div>
        </div>

        <!--travel plans-->
        <h1 class="text-2xl p-5">Travel Plans</h1>
        <div class="w-full">
            <div class="min-h-auto bg-cover bg-center shadow p-4">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-6">
                    <!-- 1. Created Plans -->
                    <div class="bg-white dark:bg-gray-700 p-4 rounded-lg border">
                        <h2 class="text-lg font-bold mb-2"><i class="fa-solid fa-clipboard-check text-teal-500 text-2xl mr-2"></i>
                            <span class="text-orange-500">CREATED </span>
                            <span class="text-sky-700">Plans</span>
                        </h2>
                        <div class="space-y-4">
                            <div class="bg-gray-100 dark:bg-gray-800 p-3 rounded-lg">
                                <h3 class="font-semibold text-gray-800 dark:text-gray-200 mb-1">Japan</h3>
                                <span class="list-disc list-inside space-y-1 text-gray-600 dark:text-gray-500 text-sm">
                                    Plan:Going to see cherry blossoms in Nara
                                </span>
                            </div>
                            <div class="bg-gray-100 dark:bg-gray-800 p-3 rounded-lg">
                                <h3 class="font-semibold text-gray-800 dark:text-gray-200 mb-1">Italy</h3>
                                <span class="list-disc list-inside space-y-1 text-gray-600 dark:text-gray-500 text-sm">
                                    Plan: Dreaming of a trip to Venice
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- 2. Joined Plans -->
                    <div class="bg-white dark:bg-gray-700 p-4 rounded-lg border">
                        <h2 class="text-lg font-bold mb-2">
                            <i class="fa-solid fa-handshake text-yellow-500 text-2xl mr-2"></i>
                            <span class="text-sky-700">JOINED </span>
                            <span class="text-orange-500">Plans</span>
                        </h2>
                        <div class="space-y-4">
                            <div class="bg-gray-100 dark:bg-gray-800 p-3 rounded-lg">
                                <h3 class="font-semibold text-gray-800 dark:text-gray-200 mb-1">France</h3>
                                <span class="list-disc list-inside space-y-1 text-gray-600 dark:text-gray-500 text-sm">
                                    Plan:
                                </span>
                            </div>
                            <div class="bg-gray-100 dark:bg-gray-800 p-3 rounded-lg">
                                <h3 class="font-semibold text-gray-800 dark:text-gray-200 mb-1">Italy</h3>
                                <span class="list-disc list-inside space-y-1 text-gray-600 dark:text-gray-500 text-sm">
                                    Plan: Dreaming of a trip to Venice
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- 3. Interested Plans -->
                    <div class="bg-white dark:bg-gray-700 p-4 rounded-lg border">
                        <h2 class="text-lg font-bold mb-2"><i class="fa-solid fa-flag text-green-500 text-2xl mr-2"></i>
                            <span class="text-orange-500">INTERESTED </span>
                            <span class="text-sky-700">Plans</span>
                        </h2>
                        <div class="space-y-4">
                            <div class="bg-gray-100 dark:bg-gray-800 p-3 rounded-lg">
                                <h3 class="font-semibold text-gray-800 dark:text-gray-200 mb-1">France</h3>
                                <span class="list-disc list-inside space-y-1 text-gray-600 dark:text-gray-500 text-sm">
                                    Plan:Visit Paris and enjoy pastries
                                </span>
                            </div>
                            <div class="bg-gray-100 dark:bg-gray-800 p-3 rounded-lg">
                                <h3 class="font-semibold text-gray-800 dark:text-gray-200 mb-1">Italy</h3>
                                <span class="list-disc list-inside space-y-1 text-gray-600 dark:text-gray-500 text-sm">
                                    Plan: Dreaming of a trip to Venice
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- 4. Liked Plans -->
                    <div class="bg-white dark:bg-gray-700 p-4 rounded-lg border">
                        <h2 class="text-lg font-bold mb-2"><i class="fa-solid fa-heart text-red-500 text-2xl mr-2"></i>
                            <span class="text-orange-500">LIKED </span>
                            <span class="text-sky-700">Plans</span>
                        </h2>

                        <div class="space-y-4">
                            <div class="bg-gray-100 dark:bg-gray-800 p-3 rounded-lg">
                                <h3 class="font-semibold text-gray-800 dark:text-gray-200 mb-1">France</h3>
                                <span class="list-disc list-inside space-y-1 text-gray-600 dark:text-gray-500 text-sm">
                                    Plan:Visit Paris and enjoy pastries
                                </span>
                            </div>
                            <div class="bg-gray-100 dark:bg-gray-800 p-3 rounded-lg">
                                <h3 class="font-semibold text-gray-800 dark:text-gray-200 mb-1">Italy</h3>
                                <span class="list-disc list-inside space-y-1 text-gray-600 dark:text-gray-500 text-sm">
                                    Plan: Dreaming of a trip to Venice
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- @foreach ($plansByCountry as $country => $plans)
            <div class="bg-gray-100 dark:bg-gray-800 p-3 rounded-lg">
                <h3 class="font-semibold text-gray-800 dark:text-gray-200 mb-2">{{ $country }}</h3>
        <ul class="list-disc list-inside space-y-1 text-gray-600 dark:text-gray-400 text-sm">
            @foreach ($plans as $plan)
            <li>{{ $plan->description }}</li>
            @endforeach
        </ul>
    </div>
    @endforeach --}}

    <!--add calender -->
    <h1 class="text-2xl p-5">Schedule</h1>
    <div class="w-full">
        <p class="m-3">add calender!!! not yet</p>
    </div>

    <!--add calender -->
    <h1 class="text-2xl p-5">3 essentials for may travel <span class="text-orange-500">style</span></h1>
    <div class="w-full flex items-center m-2">
        <div class="flex-none w-4/10">
            <div class="w-36 h-36 bg-white flex items-center justify-center border border-orange-500 overflow-hidden rounded-md">
                <img src="{{ asset('images/airplane.png') }}"
                    alt="Sample" class="w-full h-full object-cover">
            </div>
        </div>
        <!--user info-->
        <div class="flex-1 w-6/10 p-2">
            <h3 class="text-lg sm:text-2xl md:text-3xl font-bold">Item name</h3>
            <!--introduction about goods-->
            <div class="mt-4 space-y-4">
                <div class="flex items-center space-x-3">
                    <p>I recommend this eye mask for sleeping on planes. It soothes tired eyes...</p>
                    <x-secondary-button>read more...</x-secondary-button>
                </div>
                <div class="flex items-center space-x-2">
                    <i class="fa-solid fa-link text-blue-800"></i>
                    <p class="text-blue-600 underline">https://amazon.</p>
                </div>


            </div>
        </div>
    </div>
</x-app-layout>