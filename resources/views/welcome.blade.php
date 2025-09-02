<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles / Scripts -->

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    {{-- fontawesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

    @include('layouts.navigation')

    <div class="w-full h-[45vh] bg-[length:100%_100%] bg-no-repeat text-white flex flex-col items-center justify-center text-center px-4" style="background-image: url('/images/krabi_beach_2.png');">

        <h1 class="text-3xl md:text-5xl font-bold leading-tight">Same Day, Same Destination, and Same Style</h1>
        <p class="text-xl md:text-2xl mt-2">Join others' trip. This is where your shared journeys begin.</p>
    </div>

    <div class="w-full bg-white text-center py-8 px-4">
        <p class="text-[2.0vw] mb-2 text-gray-500">From Full Trips to Just a Meal — Share Any Part of the Journey.</p>
        <p class="text-[2.0vw] mb-2 text-gray-500">Big Adventures or Small Plans — Travel Together, Your Way.</p>
        <p class="text-[2.0vw] mb-2 text-gray-500">Whether It's the Whole Trip or Just Dinner — Connect and Go.</p>
        <p class="text-[2.0vw] mb-2 text-gray-500">One App for Every Plan — From Full Journeys to Quick Meetups.</p>

        <!-- Right button -->
        <div class="flex justify-end w-full">
            <x-primary-button class="mr-10 px-6 py-3 text-lg">Join Now</x-primary-button>
        </div>
    </div>

    <div class="w-full bg-white px-4 py-8">
        <!-- feed back -- tittle -->
        <x-title><h2 class="text-2xl font-bold text-gray-800 text-left mb-6">Actual feed from participants</h2>
        </x-title>

        

        <!-- make 3cards -->
        <div class="flex gap-4">
            <!-- card1 feed back -->
            <div class="bg-gray-100 rounded-lg shadow-md w-1/3 flex flex-col">
                <!-- head（avatar＋name） -->
                <div class="px-4 py-2 border-b border-gray-300 flex items-center gap-2">
                    <i class="fa-solid fa-user"></i>
                    <span class="font-bold text-gray-800">Participant A</span>
                </div>
                <!-- body -->
                <div class="px-4 py-4 flex-1 text-gray-700">"This trip was amazing! I met so many new people."</div>
                <!-- footer -->
                <div class="px-4 py-2 border-t border-gray-300 text-sm text-gray-500">2 days ago</div>
            </div>

            <!-- card2 feed back -->
            <div class="bg-gray-100 rounded-lg shadow-md w-1/3 flex flex-col">
                <div class="px-4 py-2 border-b border-gray-300 flex items-center gap-2">
                    <i class="fa-solid fa-user"></i>
                    <span class="font-bold text-gray-800">Participant B</span>
                </div>
                <div class="px-4 py-4 flex-1 text-gray-700">"I loved sharing my experience and seeing others' plans."</div>
                <div class="px-4 py-2 border-t border-gray-300 text-sm text-gray-500">3 days ago</div>
            </div>

            <!-- card3 feedback -->
            <div class="bg-gray-100 rounded-lg shadow-md w-1/3 flex flex-col">
                <div class="px-4 py-2 border-b border-gray-300 flex items-center gap-2">
                    <i class="fa-solid fa-user"></i>
                    <span class="font-bold text-gray-800">Participant C</span>
                </div>
                <div class="px-4 py-4 flex-1 text-gray-700">"Such a convenient app for coordinating group trips!"</div>
                <div class="px-4 py-2 border-t border-gray-300 text-sm text-gray-500">1 week ago</div>
            </div>
        </div>
    </div>
        <div class="w-full bg-white px-4 py-8">
            <!-- what can do -- title -->
            <h2 class="text-2xl font-bold text-gray-800 text-left mb-6">What you can do this website?</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- 2line in pC、1line use the phone -->
                    <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
                         <h3 class="text-3xl font-bold mb-2"><i class="fa-solid fa-magnifying-glass"></i></h3>
                         <h3 class="text-3xl font-bold mb-2">Find the trip you want to go on!</h3>
                         <p class="text-gray-600">Search your travel destinations, dates, OR your fun- sharing account</p>
                     </div>
                     <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
                        <h3 class="text-3xl font-bold mb-2"><i class="fa-solid fa-hammer"></i></h3>
                         <h3 class="text-3xl font-bold mb-2">Share the journey you want to enjoy with someone!</h3>
                         <p class="text-gray-600">You can make a new travel plan. And let's enjoy the trip with some joiner!</p>
                    </div>
                </div>
        </div>
        <div class="w-full bg-white px-4 py-8">
        <!-- how to find -- title -->
        <h2 class="text-2xl font-bold text-gray-800 text-left mb-6">How to find other's plan?</h2>

        <section class="max-w-7xl mx-auto px-4 py-8 grid grid-cols-1 md:grid-cols-3 gap-6">
             <!-- card1 -->
            <div class="border-8 border-sky-700 rounded-lg overflow-hidden p-6 flex flex-col items-start">
                <h3 class="text-xl font-bold mb-2 flex items-center">
                <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-sky-700 text-white mr-2">1</span>
                </h3>
                <p class="text-2xl font-bold text-gray-700 mb-4">Find the trip you want to go on by CALENDER or DESTINATION.</p>
                <img src="/images/1st_find_icon.png" alt="find icon" class="w-40 h-40 md:w-56 md:h-56 object-contain self-start"/>
            </div>

            <!-- card2 -->
            <div class="border-8 border-sky-700 rounded-lg overflow-hidden p-6 flex flex-col items-start">
                <h3 class="text-xl font-bold mb-2 flex items-center">
                <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-sky-700 text-white mr-2">2</span>
                </h3>
                <p class="text-2xl font-bold text-gray-700 mb-4">If you find a trip you LOVE, let's do something action!</p>
                <img src="/images/2nd_find_icon.png" alt="find icon" class="w-40 h-40 md:w-56 md:h-56 object-contain self-start"/>
            </div>

            <!-- card3 -->
            <div class="border-8 border-sky-700 rounded-lg overflow-hidden p-6 flex flex-col items-start">
                <h3 class="text-xl font-bold mb-2 flex items-center">
                <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-sky-700 text-white mr-2">3</span>
                </h3>
                <p class="text-2xl font-bold text-gray-700 mb-4">Start chatting with your travel mate about your shared travel!</p>
                <img src="/images/3rd_find_icon.png" alt="find icon" class="w-40 h-40 md:w-56 md:h-56 object-contain self-start"/>
            </div>
        </section>
        </div>
        <div class="w-full bg-white px-4 py-8">
                <!-- how to screen shot -- tittle -->
                <h2 class="text-2xl font-bold text-gray-800 text-left mb-6">Find travel mate on same date, destination, and style</h2>
            </div>
            <section class="max-w-5xl mx-auto px-4 py-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <!-- 1 -->
                    <div class="bg-white border-2 border-blue-500 rounded-lg overflow-hidden">
                        <h1>Calender page</h1>
                        <img src="/images/search_image.png" alt="screenshot1" class="w-full h-auto">
                        <div class="p-4">
                            <p>description</p>
                        </div>
                    </div>

                    <!-- 2 -->
                    <div class="bg-white border-2 border-blue-500 rounded-lg overflow-hidden">
                        <h1>Plan detail page</h1>
                        <img src="/images/plan_image 1.png" alt="screenshot2" class="w-full h-auto">
                        <div class="p-4">
                            <p>description</p>
                        </div>
                    </div>

                    <!-- 3 -->
                    <div class="bg-white border-2 border-blue-500 rounded-lg overflow-hidden">
                        <h1>Profile page</h1>
                        <img src="/images/profile_image.png" alt="screenshot3" class="w-full h-auto">
                        <div class="p-4">
                            <p>description</p>
                        </div>
                    </div>

                    <!-- 4 -->
                    <div class="bg-white border-2 border-blue-500 rounded-lg overflow-hidden">
                        <h1>chat page</h1>
                        <img src="/images/chat_image.png" alt="screenshot4" class="w-full h-auto max-w-[300px] mx-auto">
                        <div class="p-4">
                            <p>description</p>
                        </div>
                    </div>
                </div>
            </section>
        </div>
         <!-- dou you wanna register? -->
         <h2 class="text-3xl font-bold text-left pl-6 mb-6">
            <span class="text-orange-500">Do you wanna</span> 
            <span class="text-sky-700">Register</span>
            <span class="text-orange-500">Samedaysty？</span>
        </h2>
         <!-- Right button -->
        <div class="flex justify-end w-full">
            <x-primary-button class="mr-10 px-6 py-3 text-lg">Join Now</x-primary-button>
        </div>
        
        <section class="max-w-4xl mx-auto my-12 p-4">
            <h2 class="text-3xl font-bold text-center mb-8">About Us</h2>

             <!-- big square -->
            <div class="grid grid-cols-2 grid-rows-2 gap-4 w-full aspect-square">
    
              <!-- member 1 -->
               <div class="flex flex-col p-4 border rounded-lg">
                  <div class="flex items-center mb-2">
                   <img src="/images/member1_icon.png" alt="Member 1" class="w-12 h-12 mr-3">
                 <h3 class="text-xl font-semibold">A</h3>
                 </div>
                 <p class="text-gray-600 text-sm">Frontend developer passionate about UI/UX design.</p>
             </div>

              <!-- member 2 -->
             <div class="flex flex-col p-4 border rounded-lg">
                 <div class="flex items-center mb-2">
                 <img src="/images/member2_icon.png" alt="Member 2" class="w-12 h-12 mr-3">
                 <h3 class="text-xl font-semibold">B</h3>
                 </div>
                 <p class="text-gray-600 text-sm">Backend developer specializing in APIs and database.</p>
              </div>

               <!-- member 3 -->
              <div class="flex flex-col p-4 border rounded-lg">
                <div class="flex items-center mb-2">
                  <img src="/images/member3_icon.png" alt="Member 3" class="w-12 h-12 mr-3">
                  <h3 class="text-xl font-semibold">C</h3>
                </div>
                <p class="text-gray-600 text-sm">Fullstack developer with a love for problem-solving.</p>
              </div>

               <!-- member 4 -->
              <div class="flex flex-col p-4 border rounded-lg">
                 <div class="flex items-center mb-2">
                 <img src="/images/member4_icon.png" alt="Member 4" class="w-12 h-12 mr-3">
                 <h3 class="text-xl font-semibold">D</h3>
               </div>
               <p class="text-gray-600 text-sm">Project manager ensuring smooth workflow and deadlines.</p>
             </div>

             </div>
        </section>


        @if (Route::has('login'))
        <div class="h-14.5 hidden lg:block"></div>
        @endif
</body>
<footer class="bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="flex justify-between items-center">
            <!-- Logo on the left -->
            <div class="flex items-center">
                <a href="{{ route('dashboard') }}" class="flex items-center">
                    <x-application-logo class="h-16 w-auto" />
                </a>
            </div>

            <!-- Links on the right -->
            <div class="flex flex-col space-y-2">
                <a href="#" class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 text-sm">
                    {{ __('Privacy Policy') }}
                </a>
                <a href="#" class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 text-sm">
                    {{ __('Terms of Service') }}
                </a>
                <a href="#" class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 text-sm">
                    {{ __('Contact') }}
                </a>
                <a href="#" class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 text-sm">
                    {{ __('About') }}
                </a>
            </div>
        </div>

        <!-- Copyright -->
        <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
            <div class="text-center text-gray-500 dark:text-gray-400 text-sm">
                © {{ date('Y') }} {{ config('app.name', 'Laravel') }}. {{ __('All rights reserved.') }}
            </div>
        </div>
    </div>
</footer>

</html>
