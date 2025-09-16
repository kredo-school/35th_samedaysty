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


    <div class="w-full h-[45vh] bg-cover bg-center text-white flex flex-col items-center justify-center text-center px-4" style="background-image: url('/images/krabi_beach_2.png');">
        <h1 class="text-3xl md:text-5xl font-bold leading-tight text-center">
            Same Day, Same Destination, and Same Style
        </h1>
        <p class="text-lg md:text-2xl mt-4 text-center">
            Join others' trip. This is where your shared journeys begin.
        </p>
    </div>

    <div class="w-full bg-white text-center py-8 px-4">
        <p class="text-[2.0vw] mb-2 text-gray-500">Share Moments, Big or Small — Your Way, Together.</p>
        <p class="text-[2.0vw] mb-2 text-gray-500">From Coffee to Adventures — Connect & Enjoy.</p>
        <p class="text-[2.0vw] mb-2 text-gray-500">Meet, Share, Explore — Your Journey, Your Way.</p>
        <p class="text-[2.0vw] mb-2 text-gray-500">One App for Every Plan — From Full Journeys to Quick Meetups.</p>
        <p class="text-[2.0vw] mb-2 text-gray-500">For just lunch, a quick activity, or part of the journey — it's all possible.</p>

        <!-- Right button -->
        <div class="flex justify-end w-full">
            <x-primary-button onclick="window.location='{{ route('register') }}'" class="mr-10 px-6 py-3 text-lg">Join Now</x-primary-button>
        </div>
    </div>

    <div class="w-full bg-white mt-24">
        <!-- feed back -- tittle -->
        <x-title>
            {{ __('Actual feed from participants') }}
        </x-title>
        <!-- make 3cards -->
        <div class="flex gap-4 px-4 py-16">
            <!-- card1 feed back -->
            <div class="bg-gray-100 rounded-lg shadow-md w-1/3 flex flex-col">
                <!-- head（avatar＋name） -->
                <div class="px-4 py-2 border-b border-gray-300 flex items-center gap-2">
                    <i class="fa-solid fa-user"></i>
                    <span class="font-bold text-gray-800">Participant A</span>
                </div>
                <!-- body -->
                <div class="px-4 py-4 flex-1 text-gray-700">"This trip was amazing! I met so many new people."</div>
                <img src="/images/1st_find_other's_plan.png" alt="trip photo" class="w-full h-40 object-contain rounded-b-lg">
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
                <img src="/images/2nd_find_other's_plan 4.png" alt="trip photo" class="w-full h-40 object-contain rounded-b-lg">
                <div class="px-4 py-2 border-t border-gray-300 text-sm text-gray-500">3 days ago</div>
            </div>

            <!-- card3 feedback -->
            <div class="bg-gray-100 rounded-lg shadow-md w-1/3 flex flex-col">
                <div class="px-4 py-2 border-b border-gray-300 flex items-center gap-2">
                    <i class="fa-solid fa-user"></i>
                    <span class="font-bold text-gray-800">Participant C</span>
                </div>
                <div class="px-4 py-4 flex-1 text-gray-700">"Such a convenient app for coordinating group trips!"</div>
                <img src="/images/3rd_find_other's_plan 9.png" alt="trip photo" class="w-full h-40 object-contain rounded-b-lg">
                <div class="px-4 py-2 border-t border-gray-300 text-sm text-gray-500">1 week ago</div>
            </div>
        </div>
    </div>
    <div class="w-full bg-white mt-16">
        <!-- what can website -- title -->
        <x-title>
            {{ __('What you can do this website?') }}
        </x-title>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 px-4 py-16">
            <!-- 2line in pC、1line use the phone -->
            <div class="border-4 border-sky-700 rounded overflow-hidden p-6 flex flex-col items-start">
                <h3 class="text-3xl font-bold mb-2"><i class="fa-solid fa-magnifying-glass"></i></h3>
                <h3 class="text-3xl font-bold mb-2">Find the trip you want to go on !</h3>
                <p class="text-gray-600">Don't want to plan? Just hop on a trip that's already ready to go. Search your travel destinations, dates, or your fun- sharing account !Discover available trips and request to join the ones you like !</p>
            </div>
            <div class="border-4 border-sky-700 rounded overflow-hidden p-6 flex flex-col items-start">
                <h3 class="text-3xl font-bold mb-2"><i class="fa-solid fa-hammer"></i></h3>
                <h3 class="text-3xl font-bold mb-2">Create and Share Your Trip Plan !</h3>
                <p class="text-gray-600">Got a trip in mind? See who's excited to join you on the road. Turn your travel idea into a real journey by posting your plan.
                    Invite others and start your adventure together !</p>
            </div>
        </div>
    </div>
    <div class="w-full bg-white mt-16">
        <!-- how to find -- title -->
        <x-title>
            {{ __('How to find others plan') }}
        </x-title>
        <section class="max-w-7xl mx-auto px-4 py-12 grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- card1 -->
            <div class="border-4 border-sky-700 rounded-lg overflow-hidden p-6 flex flex-col items-start">
                <h3 class="text-xl font-bold mb-2 flex items-center">
                    <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-sky-700 text-white mr-2">1</span>
                </h3>
                <p class="text-2xl font-bold text-gray-700 mb-4">Find the trip you want to go on by CALENDER or DESTINATION.</p>
                <img src="/images/1st_find_icon.png" alt="find icon" class="w-40 h-40 md:w-56 md:h-56 object-contain self-start" />
            </div>

            <!-- card2 -->
            <div class="border-4 border-sky-700 rounded-lg overflow-hidden p-6 flex flex-col items-start">
                <h3 class="text-xl font-bold mb-2 flex items-center">
                    <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-sky-700 text-white mr-2">2</span>
                </h3>
                <p class="text-2xl font-bold text-gray-700 mb-4">If you find a trip you LOVE, let's do something action!</p>
                <img src="/images/2nd_find_icon.png" alt="find icon" class="w-40 h-40 md:w-56 md:h-56 object-contain self-start" />
            </div>

            <!-- card3 -->
            <div class="border-4 border-sky-700 rounded-lg overflow-hidden p-6 flex flex-col items-start">
                <h3 class="text-xl font-bold mb-2 flex items-center">
                    <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-sky-700 text-white mr-2">3</span>
                </h3>
                <p class="text-2xl font-bold text-gray-700 mb-4">Start chatting with your travel mate about your shared travel!</p>
                <img src="/images/3rd_find_icon.png" alt="find icon" class="w-40 h-40 md:w-56 md:h-56 object-contain self-start" />
            </div>
        </section>
    </div>

    {{-- to write Categories --}}
    <div class="w-full bg-white mt-16">
        <x-title>
            {{ __('Travel style categories') }}
        </x-title>
        <section class="max-w-6xl mx-auto px-4 py-20">
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-6">

                <div class="flex flex-col items-center p-4 bg-white rounded-lg shadow text-center">
                    <i class="fa-solid fa-spa text-3xl mb-2 text-[#F5BABB]"></i>
                    <h3 class="font-semibold">Relaxation</h3>
                    <p class="text-sm text-gray-600">Hot springs, spas, beach resorts</p>
                </div>

                <div class="flex flex-col items-center p-4 bg-white rounded-lg shadow text-center">
                    <i class="fa-solid fa-person-hiking text-3xl mb-2 text-[#FFC900]"></i>
                    <h3 class="font-semibold">Adventure</h3>
                    <p class="text-sm text-gray-600">Hiking, diving, surfing</p>
                </div>

                <div class="flex flex-col items-center p-4 bg-white rounded-lg shadow text-center">
                    <i class="fa-solid fa-mountain text-3xl mb-2 text-[#239BA7]"></i>
                    <h3 class="font-semibold">Nature</h3>
                    <p class="text-sm text-gray-600">World Heritage, parks, scenic drives</p>
                </div>

                <div class="flex flex-col items-center p-4 bg-white rounded-lg shadow text-center">
                    <i class="fa-solid fa-landmark text-3xl mb-2 text-[#BB6653]"></i>
                    <h3 class="font-semibold">Cultural</h3>
                    <p class="text-sm text-gray-600">Temples, castles, museums</p>
                </div>

                <div class="flex flex-col items-center p-4 bg-white rounded-lg shadow text-center">
                    <i class="fa-solid fa-utensils text-3xl mb-2 text-[#FF8040]"></i>
                    <h3 class="font-semibold">Foodie</h3>
                    <p class="text-sm text-gray-600">Local cuisine & Michelin restaurants</p>
                </div>

                <div class="flex flex-col items-center p-4 bg-white rounded-lg shadow text-center">
                    <i class="fa-solid fa-bag-shopping text-3xl mb-2 text-[#B9375D]"></i>
                    <h3 class="font-semibold">Shopping</h3>
                    <p class="text-sm text-gray-600">Cities, outlets, duty-free</p>
                </div>

                <div class="flex flex-col items-center p-4 bg-white rounded-lg shadow text-center">
                    <i class="fa-solid fa-microphone text-3xl mb-2 text-[#00809D]"></i>
                    <h3 class="font-semibold">Fan Travel</h3>
                    <p class="text-sm text-gray-600">Anime & idol pilgrimage</p>
                </div>

                <div class="flex flex-col items-center p-4 bg-white rounded-lg shadow text-center">
                    <i class="fa-solid fa-tractor text-3xl mb-2 text-[#386641]"></i>
                    <h3 class="font-semibold">Rural</h3>
                    <p class="text-sm text-gray-600">Farming & countryside stays</p>
                </div>

                <div class="flex flex-col items-center p-4 bg-white rounded-lg shadow text-center">
                    <i class="fa-solid fa-crown text-3xl mb-2 text-[#D3AF37]"></i>
                    <h3 class="font-semibold">Luxury</h3>
                    <p class="text-sm text-gray-600">High-end resorts & villas</p>
                </div>

                <div class="flex flex-col items-center p-4 bg-white rounded-lg shadow text-center">
                    <i class="fa-solid fa-wallet text-3xl mb-2 text-[#A2AF9B]"></i>
                    <h3 class="font-semibold">Budget</h3>
                    <p class="text-sm text-gray-600">Guesthouses, capsule hotels</p>
                </div>

                <div class="flex flex-col items-center p-4 bg-white rounded-lg shadow text-center">
                    <i class="fa-solid fa-leaf text-3xl mb-2 text-[#08CB00]"></i>
                    <h3 class="font-semibold">Sustainable</h3>
                    <p class="text-sm text-gray-600">Eco-friendly & local support</p>
                </div>

                <div class="flex flex-col items-center p-4 bg-white rounded-lg shadow text-center">
                    <i class="fa-solid fa-laptop-house text-3xl mb-2 text-[#4D2D8C]"></i>
                    <h3 class="font-semibold">Workation</h3>
                    <p class="text-sm text-gray-600">Work & travel combined</p>
                </div>

                <div class="flex flex-col items-center p-4 bg-white rounded-lg shadow text-center">
                    <i class="fa-solid fa-map text-3xl mb-2 text-[#E43636]"></i>
                    <h3 class="font-semibold">Spontaneous</h3>
                    <p class="text-sm text-gray-600">Go with the flow</p>
                </div>

                <div class="flex flex-col items-center p-4 bg-white rounded-lg shadow text-center">
                    <i class="fa-solid fa-plane-departure text-3xl mb-2 text-[#3396D3]"></i>
                    <h3 class="font-semibold">Travel</h3>
                    <p class="text-sm text-gray-600">Any journey you like</p>
                </div>

                <div class="flex flex-col items-center p-4 bg-white rounded-lg shadow text-center">
                    <i class="fa-solid fa-camera-retro text-3xl mb-2 text-[#0D1164]"></i>
                    <h3 class="font-semibold">Scenic</h3>
                    <p class="text-sm text-gray-600">Beautiful drives & views</p>
                </div>
            </div>

    </div>
    </section>

    <div class="w-full bg-white mt-16">
        <!-- how to screen shot -- tittle -->
        <x-title>
            {{ __('Find travel mate on same date, destination, and style') }}
        </x-title>
    </div>
    <section class="w-full mx-auto px-4 py-8 ">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <!-- 1 -->
            <div class="bg-white border-4 border-sky-700 rounded-lg overflow-hidden p-6 flex flex-col items-start">
                <h1 class="text-xl font-semibold text-orange-500 mb-4">Calender page</h1>
                <img src="/images/newcalender.png" alt="screenshot1" class="w-full h-auto">
                <div class="p-4">
                    <p>・ Choose your travel dates and see who else is going at the same time.</p>
                </div>
            </div>

            <!-- 2 -->
            <div class="bg-white border-4 border-sky-700 rounded-lg overflow-hidden p-6 flex flex-col items-start">
                <h1 class="text-xl font-semibold text-orange-500 mb-4">Plan detail page</h1>
                <img src="/images/plandetail.png" alt="screenshot2" class="w-full h-auto">
                <div class="p-4">
                    <p>・ Share your destination and travel style so others can find a good match.</p>
                </div>
            </div>

            <!-- 3 -->
            <div class="bg-white border-4 border-sky-700 rounded-lg overflow-hidden p-6 flex flex-col items-start">
                <h1 class="text-xl font-semibold text-orange-500 mb-4">Profile page</h1>
                <img src="/images/profilepage.jpeg" alt="screenshot3" class="w-full h-auto">
                <div class="p-4">
                    <p>・ Introduce yourself and highlight your interests to connect with like-minded travelers.</p>
                </div>
            </div>

            <!-- 4 -->
            <div class="bg-white border-4 border-sky-700 rounded-lg overflow-hidden p-6 flex flex-col items-start">
                <h1 class="text-xl font-semibold text-orange-500 mb-4">Chat page</h1>
                <img src="/images/newchatpage.png" alt="screenshot4" class="w-full h-auto">
                <div class="p-4">
                    <p>・ Start chatting to finalize plans and get to know your travel mates.</p>
                </div>
            </div>
        </div>
    </section>

    <div class="w-full h-[60vh] bg-cover text-white flex flex-col justify-end mt-24 px-4 pb-8" style="background-image: url('/images/zousan.jpeg'); background-position: 40% 20%;">
        <!-- title（left side） -->
        <h2 class="text-left text-3xl md:text-4xl font-bold mt-4">
            Register to Samedaysty
        </h2>
        <!-- under sentence -->
        <p class="text-lg md:text-2xl">
            Join others' trip. This is where your shared journeys begin.
        </p>
        <p class="leading-relaxed mb-2 text-sm md:text-base mt-10">
            Every journey begins with a single step—but it's the people you travel with who make it unforgettable.
        </p>
        <p class="leading-relaxed mb-2 text-sm md:text-base">
            This platform is here to bring together planners and explorers, so you can create, share, and join trips that turn into lasting memories.
        </p>
        <p class="leading-relaxed mb-2 text-sm md:text-base">
            And the best part? It's free.
        </p>
        <!-- button（right side） -->
        <div class="flex justify-end w-full mt-4">
<a href="{{ route('register') }}" class="px-6 py-3 text-base md:text-lg inline-block text-center">
    Join Now
</a>

        </div>
    </div>

    {{-- about us --}}
    <section class="w-full bg-gray-50 mt-24 px-6 py-12">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">About Us</h2>
        <p class="text-gray-600 leading-relaxed mb-2">We're travelers, just like you.</p>
        <p class="text-gray-600 leading-relaxed mb-2">Sometimes we love planning every detail,<br>
            and sometimes we just want to hop on someone else's trip.</p>
        <p class="text-gray-600 leading-relaxed">That's why we built this space—to make it easier to find buddies, share ideas, and enjoy the journey together.</p>
    </section>

    <section class="max-w-4xl mx-auto my-4 p-4">
        <!-- big square -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 w-full mt-8">

            <!-- member 1 -->
            <div class="w-full border-8 border-sky-700 rounded-lg overflow-hidden p-6 flex flex-col items-start">
                <div class="flex items-center mb-2">
                    <img src="/images/aboutus_rinsan.png" alt="Member 1" class="w-28 h-28 mr-3">
                    <h3 class="text-xl font-semibold">Rintaro</h3>
                </div>
                <div class="items-baseline">
                    <p class="underline decoration-orange-300 decoration-2 mr-2">Hobby:</p>
                    <p><i class="fa-solid fa-dumbbell mr-2"></i>Movies,Tennis,Workout</p>
                </div>
                <div class="items-baseline">
                    <p class="underline decoration-orange-300 decoration-2 mr-2">Favorite Food:</p>
                    <p><i class="fa-solid fa-drumstick-bite mr-2"></i>Nasi goreng, Kebab</p>
                </div>
                <div class="items-baseline">
                    <p class="underline decoration-orange-300 decoration-2 mr-2">Favorite Country:</p>
                    <p><i class="fa-solid fa-mountain-sun mr-2"></i>Japan,Taiwan,Vietnam,Thailand</p>
                </div>
                <div class="items-baseline">
                    <p class="underline decoration-orange-300 decoration-2 mr-2">Why this site matters:</p>
                    <p class="ms-4">I hope this site will help people who usually travel alone and are looking for someone to share experiences with. I also hope it will be useful for us in finding new job opportunities.</p>
                </div>
                <div class="items-baseline">
                    <p class="underline decoration-orange-300 decoration-2 mr-2">Why I made it:</p>
                    <p class="ms-4"> First of all, we share a common passion — traveling abroad. That’s why we decided to make travel the main focus of our app. With this app, people can search for travel buddies who have similar travel styles and preferences. One of us once had a difficult experience while traveling with a friend, which inspired us to include a feature that allows users to filter potential buddies by their travel preferences. We hope this function will be helpful.</p>
               </div>
                <div class="items-baseline">
                    <p class="underline decoration-orange-300 decoration-2 mr-2">Contact:</p>
                    <p>instagram @imnotmvrk_</p>
                </div>
            </div>

            <!-- member 2 -->
            <div class="w-full border-8 border-sky-700 rounded-lg overflow-hidden p-6 flex flex-col items-start whitespace-normal break-words">
                <div class="flex items-center mb-2">
                    <img src="/images/aboutus_nanamin.jpeg" alt="Member 2" class="w-30 h-28 mr-3">
                    <h3 class="text-xl font-semibold">Hayato</h3>
                </div>
                <div class="items-baseline">
                    <p class="underline decoration-orange-300 decoration-2 mr-2">Hobby:</p>
                    <p><i class="fa-solid fa-bicycle mr-2"></i>Music, Cycling, Walking</p>
                </div>
                <div class="items-baseline">
                    <p class="underline decoration-orange-300 decoration-2 mr-2">Favorite Food:</p>
                    <p><i class="fa-solid fa-fish mr-2"></i>Asian Food</p>
                </div>
                <div class="items-baseline">
                    <p class="underline decoration-orange-300 decoration-2 mr-2">Favorite Country:</p>
                    <p><i class="fa-solid fa-gopuram mr-2"></i>Philippines,Thailand</p>
                </div>
                <div class="items-baseline">
                    <p class="underline decoration-orange-300 decoration-2 mr-2">Why this site matters:</p>
                    <p class="ms-4">We sincerely hope that this app will not only make your travel experiences wonderful but also help you discover new places, connect with people, and create memorable moments along the way. Our wish is that it becomes a companion that makes every journey, big or small, more enjoyable and meaningful.</p>
                </div>
                <div class="items-baseline">
                    <p class="underline decoration-orange-300 decoration-2 mr-2">Why I made it:</p>
                    <p class="ms-4"> The main reason we created this app is simple: every member of our team has a deep love for “travel.” We believe that traveling opens doors to new cultures, fresh perspectives, and unforgettable stories. With that passion in mind, we wanted to build a tool that makes it easier for fellow travelers to plan, share, and enjoy their journeys to the fullest.</p>
                </div>
                <div class="items-baseline">
                    <p class="underline decoration-orange-300 decoration-2 mr-2">Contact:</p>
                    <p>Instagram:https://www.instagram.com/hayato.moo/</p>
                </div>
            </div>

            <!-- member 3 -->
            <div class="w-full h-300 border-8 border-sky-700 rounded-lg overflow-hidden p-6 flex flex-col items-start whitespace-normal break-words">
                <div class="flex items-center mb-2">
                    <img src="/images/aboutus_kimikosan.png" alt="Member 3" class="w-28 h-28 mr-3">
                    <h3 class="text-xl font-semibold">Kimiko</h3>
                </div>
                <div class="items-baseline">
                    <p class="underline decoration-orange-300 decoration-2 mr-2">Hobby:</p>
                    <p><i class="fa-solid fa-book mr-2"></i>Traveling,Visiting cafe and Reading books</p>
                </div>
                <div class="items-baseline">
                    <p class="underline decoration-orange-300 decoration-2 mr-2">Favorite Food:</p>
                    <p><i class="fa-solid fa-ice-cream mr-2"></i>Sweets in general</p>
                </div>
                <div class="items-baseline">
                    <p class="underline decoration-orange-300 decoration-2 mr-2">Favorite Country:</p>
                    <p class="flex items-center"><img src="/images/dragon.png" alt="kiwi" class="w-6 h-6 mr-3">Vietnam</p>
                </div>
                <div class="items-baseline">
                    <p class="underline decoration-orange-300 decoration-2 mr-2">Why this site matters:</p>
                    <p class="ms-4">If you feel like traveling, that's the perfect time to go. Follow your heart and enjoy the journey!</p>
                </div>
                <div class="items-baseline">
                    <p class="underline decoration-orange-300 decoration-2 mr-2">Why I made it:</p>
                    <p class="ms-4">Traveling is way more fun with people who get your vive-that's why I made this site!</p>
                </div>
                <div class="items-baseline">
                    <p class="underline decoration-orange-300 decoration-2 mr-2">Contact:</p>
                    <p>Instagram</p>
                </div>
            </div>

            <!-- member 4 -->
            <div class="max-w-3xl border-8 border-sky-700 rounded-lg overflow-hidden p-6 flex flex-col items-start">
                <div class="flex items-center mb-2">
                    <img src="/images/aboutus_risa.jpeg" alt="Member 4" class="w-28 h-28 mr-3">
                    <h3 class="text-xl font-semibold">Risa</h3>
                </div>
                <div class="items-baseline">
                    <p class="underline decoration-orange-300 decoration-2 mr-2">Hobby:</p>
                    <p><i class="fa-solid fa-music mr-2"></i>Music, Walking, Traveling</p>
                </div>
                <div class="items-baseline">
                    <p class="underline decoration-orange-300 decoration-2 mr-2">Favorite Food:</p>
                    <p><i class="fa-solid fa-shrimp mr-2"></i>Shrimp & Shine Muscat Grapes & Onigirisen OTSU</p>
                </div>
                <div class="items-baseline">
                    <p class="underline decoration-orange-300 decoration-2 mr-2">Favorite Country:</p>
                    <p class="flex items-center"><img src="/images/sharingan_kiwi.png" alt="kiwi" class="w-6 h-6 mr-3">Australia</p>
                </div>
                <div class="items-baseline">
                    <p class="underline decoration-orange-300 decoration-2 mr-2">Why this site matters:</p>
                    <p class="ms-4">I wanted to create a space where people can easily connect, share ideas, and travel together.</p>
                </div>
                <div class="items-baseline">
                    <p class="underline decoration-orange-300 decoration-2 mr-2">Why I made it:</p>
                    <p class="ms-4">Because I believe adventures are better when shared.</p>
                </div>
                <div class="items-baseline">
                    <p class="underline decoration-orange-300 decoration-2 mr-2">Contact:</p>
                    <p>Instagram</p>
                </div>
            </div>
        </div>
    </section>
    @if (Route::has('login'))
    <div class="h-14.5 hidden lg:block"></div>
    @endif

    <x-footer></x-footer>
</body>
</html>
