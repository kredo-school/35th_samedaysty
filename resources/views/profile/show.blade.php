<x-app-layout>
    <!--header profile-->
    <div class="">
        <x-title name="header">
            {{ __('Profile') }}
        </x-title>
    </div>
    <!--avatar -->
    <div class="flex items-start space-x-8 p-2">
        <div class="flex-none_w-4/10">
            <div class="w-36 h-36 rounded-full bg-white flex items-center justify-center border border-orange-500">
                <i class="fa-solid fa-dragon text-gray-600 text-8xl"></i>
            </div>
        </div>
        <!--user info-->
        <div class="flex-1 w-6/10">
            <h3 class="text-lg  sm:text-2xl md:text-3xl font-bold">{{ $user->name }}</h3>
            <!--count-->
            <div class="mt-4 flex space-x-6">
                <div class="flex items-center space-x-3">
                    <span class="text-gray-500">Posts</span>
                    <span class="font-bold">10{{--{{ $postsCount }}--}}</span>
                </div>
                <div class="flex items-center space-x-3>
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
                <p class="text-sm text-gray-500 mt-3 leading relaxed break-words">I'd love to go on a trip
                    someday. Would anyone like to join me? Whatever happens, if we're together, we can laugh and
                    keep moving forward. I've been liking my favorite travel plans, and lately, I really want to
                    visit Da Nang in Vietnam to see the dragon.{{--$introduction--}}
                </p>
            </div>
            <!--add edit link-->
            <div class="flex space-x-4 mt-4">
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
            </div>
        </div>
    </div>
    <!--travel plans-->
    <div class="py-4">
        <div class="w-full">
            <div class="bg-gray-200 dark:bg-gray-800 overflow-hidden shadow-sm">
                <div class="min-h-screen bg-cover bg-center shadow-lg p-4">
                    <!-- レスポンシブグリッド -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        <!-- 1. Created Plans -->
                        <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow">
                            <h2 class="text-lg font-bold mb-2">CREATED Plans</h2>
                            <div class="flex items-start space-x-3">
                                <i class="fa-solid fa-map-marker-alt text-orange-500 text-2xl mt-1"></i>
                                <div class="flex flex-col space-y-1">
                                    <span class="font-semibold">Japan</span>
                                    <span>Plan: Experience hanami! (cherry blossom viewing)</span>
                                </div>
                            </div>
                        </div>

                        <!-- 2. Joined Plans -->
                        <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow">
                            <h2 class="text-lg font-bold mb-2">JOINED Plans</h2>
                            <div class="flex items-start space-x-3">
                                <i class="fa-solid fa-plane text-blue-500 text-2xl mt-1"></i>
                                <div class="flex flex-col space-y-1">
                                    <span class="font-semibold">Vietnam</span>
                                    <span>Plan: Explore Da Nang together!</span>
                                </div>
                            </div>
                        </div>

                        <!-- 3. Interested Plans -->
                        <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow">
                            <h2 class="text-lg font-bold mb-2">INTERESTED Plans</h2>
                            <div class="flex items-start space-x-3">
                                <i class="fa-solid fa-heart text-red-500 text-2xl mt-1"></i>
                                <div class="flex flex-col space-y-1">
                                    <span class="font-semibold">Italy</span>
                                    <span>Plan: Dreaming of a trip to Venice</span>
                                </div>
                            </div>
                        </div>

                        <!-- 4. Liked Plans -->
                        <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow">
                            <h2 class="text-lg font-bold mb-2">LIKED Plans</h2>
                            <div class="flex items-start space-x-3">
                                <i class="fa-solid fa-star text-yellow-500 text-2xl mt-1"></i>
                                <div class="flex flex-col space-y-1">
                                    <span class="font-semibold">France</span>
                                    <span>Plan: Visit Paris and enjoy pastries</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>