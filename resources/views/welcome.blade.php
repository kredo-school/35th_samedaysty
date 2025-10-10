<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles / Scripts -->

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    {{-- fontawesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- ✅ Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <style>
        /* Swiper size */
        .swiper {
            width: 100%;
            height: 400px;
        }

        .swiper-slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>

</head>

<body class="dark:bg-gray-900">

    @include('layouts.navigation')

    <!-- ✅ Swiper main -->
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <img src="{{ asset('images/krabi_beach_2.png') }}" class="w-full h-full object-cover" alt="1">
                <div class="absolute inset-0 bg-black/40 flex flex-col justify-center items-center text-white">
                    <h2 class="text-3xl font-bold mb-2">Same Day, Same Destination, and Same Style</h2>
                    <p class="text-lg">“ Join others' trip. This is where your shared journeys begin.”</p>
                </div>
            </div>
            <div class="swiper-slide">
                <img src="{{ asset('images/travel77.jpeg') }}" class="w-full h-full object-cover object-[50%_20%]" alt="Travel 2">
                <div class="absolute inset-0 bg-black/30 flex flex-col justify-center items-center text-white">
                    <h2 class="text-3xl font-bold mb-2">Same Day, </h2>
                    <p class="text-lg">“Find others traveling the same day — and start your story together.”</p>
                </div>
            </div>
            <div class="swiper-slide">
                <img src="{{ asset('images/travel6.jpeg') }}" class="w-full h-full object-cover" alt="Travel 2">
                <div class="absolute inset-0 bg-black/30 flex flex-col justify-center items-center text-white">
                    <h2 class="text-3xl font-bold mb-2">Same Destination, </h2>
                    <p class="text-lg">“Meet travelers heading to the same destination and share the journey.”</p>
                </div>
            </div>
            <div class="swiper-slide">
                <img src="{{ asset('images/travel159.jpeg') }}" class="w-full h-full object-cover" alt="Travel 3">
                <div class="absolute inset-0 bg-black/30 flex flex-col justify-center items-center text-white">
                    <h2 class="text-3xl font-bold mb-2">and Same Style</h2>
                    <p class="text-lg">Your travel style says who you are — find those who feel the same.</p>
                </div>
            </div>
        </div>
        <div class="swiper-pagination"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    </div>

    <!-- ✅ Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        new Swiper(".mySwiper", {
            loop: true,
            autoplay: { delay: 6000 },
            effect: "fade",
            pagination: { el: ".swiper-pagination", clickable: true },
            navigation: { nextEl: ".swiper-button-next", prevEl: ".swiper-button-prev" },
        });
    </script>

    <div class="w-full text-[clamp(14px,2vw,24px)] mb-2 text-gray-500 dark:text-white text-center py-8 px-4">
        <p class="mb-2">Share Moments, Big or Small — Your Way, Together.</p>
        <p class="mb-2">From Coffee to Adventures — Connect & Enjoy.</p>
        <p class="mb-2">Meet, Share, Explore — Your Journey, Your Way.</p>
        <p class="mb-2">One App for Every Plan — From Full Journeys to Quick Meetups.</p>
        <p class="mb-2">For just lunch, a quick activity, or part of the journey — it's all
            possible.</p>

        <!-- Right button -->
        <div class="flex justify-end w-full mt-4">
            <x-primary-button class="px-8 py-4 text-xl">
                <a href="{{ route('register') }}">
                    {{ __('Join Now') }}
                </a>
            </x-primary-button>
        </div>

    </div>

    <div class="w-full mt-16">
        <!-- what can website -- title -->
        <x-title>
            {{ __('What you can do this website?') }}
        </x-title>

        <div
            class="grid grid-cols-1 md:grid-cols-2 gap-6 px-4 py-16 text-lg font-bold text-gray-700 dark:text-gray-300">
            <!-- Box 1 -->
            <div class="flex flex-col items-start">
                <!-- above the box -->
                <h3 class="text-2xl font-bold mb-4 flex items-center">
                    <i class="fa-solid fa-magnifying-glass text-3xl mr-2"></i>
                    Find the trip you want to go on !
                </h3>
                <!-- inside the box -->
                <div class="border-4 border-sky-700 rounded overflow-hidden p-6 w-full">
                    <p>
                        Don't want to plan? Just hop on a trip that's already ready to go.
                        Search your travel destinations, dates, or your fun-sharing account!
                        Discover available trips and request to join the ones you like!
                    </p>
                </div>
            </div>

            <!-- Box 2 -->
            <div class="flex flex-col items-start">
                <h3 class="text-2xl font-bold mb-4 flex items-center">
                    <i class="fa-solid fa-hammer text-3xl mr-2"></i>
                    Create and Share Your Trip Plan !
                </h3>
                <div class="border-4 border-sky-700 rounded overflow-hidden p-6 w-full">
                    <p>
                        Got a trip in mind? See who's excited to join you on the road.
                        Turn your travel idea into a real journey by posting your plan.
                        Invite others and start your adventure together!
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="w-full mt-16">
        <!-- how to find -- title -->
        <x-title>
            {{ __('How to find others plan') }}
        </x-title>
        <section
            class="max-w-7xl mx-auto px-4 py-12 grid grid-cols-1 md:grid-cols-3 gap-6 text-gray-700 dark:text-gray-300">
            <!-- card1 -->
            <div class="border-4 border-sky-700 rounded-lg overflow-hidden p-6 flex flex-col items-start">
                <h3 class="text-xl font-bold mb-2 flex items-center">
                    <span
                        class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-sky-700 text-white mr-2">1</span>
                </h3>
                <p class="text-2xl font-bold mb-4">Find the trip you want to go on by CALENDER or
                    DESTINATION.</p>
                <img src="/images/1st_find_icon.png" alt="find icon"
                    class="w-40 h-40 md:w-56 md:h-56 object-contain self-start" />
            </div>

            <!-- card2 -->
            <div class="border-4 border-sky-700 rounded-lg overflow-hidden p-6 flex flex-col items-start">
                <h3 class="text-xl font-bold mb-2 flex items-center">
                    <span
                        class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-sky-700 text-white mr-2">2</span>
                </h3>
                <p class="text-2xl font-bold mb-4">If you find a trip you LOVE, let's do something action!
                </p>
                <img src="/images/2nd_find_icon.png" alt="find icon"
                    class="w-40 h-40 md:w-56 md:h-56 object-contain self-start" />
            </div>

            <!-- card3 -->
            <div class="border-4 border-sky-700 rounded-lg overflow-hidden p-6 flex flex-col items-start">
                <h3 class="text-xl font-bold mb-2 flex items-center">
                    <span
                        class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-sky-700 text-white mr-2">3</span>
                </h3>
                <p class="text-2xl font-bold mb-4">Start chatting with your travel mate about your shared
                    travel!</p>
                <img src="/images/3rd_find_icon.png" alt="find icon"
                    class="w-40 h-40 md:w-56 md:h-56 object-contain self-start" />
            </div>
        </section>
    </div>

    {{-- to write Categories --}}
    <div class="w-full mt-16">
        <x-title>
            {{ __('Travel style categories') }}
        </x-title>
        <section class="max-w-6xl mx-auto px-4 py-20">
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-6">

                <div class="flex flex-col items-center p-4  rounded-lg border-4 border-sky-700 shadow text-center">
                    <i class="fa-solid fa-spa text-3xl mb-2 text-[#F5BABB]"></i>
                    <h3 class="font-semibold">Relaxation</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-200">Hot springs, spas, beach resorts</p>
                </div>

                <div class="flex flex-col items-center p-4 border-4 border-sky-700 rounded-lg shadow text-center">
                    <i class="fa-solid fa-person-hiking text-3xl mb-2 text-[#FFC900]"></i>
                    <h3 class="font-semibold">Adventure</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-200">Hiking, diving, surfing</p>
                </div>

                <div class="flex flex-col items-center p-4 border-4 border-sky-700 rounded-lg shadow text-center">
                    <i class="fa-solid fa-mountain text-3xl mb-2 text-[#239BA7]"></i>
                    <h3 class="font-semibold">Nature</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-200">World Heritage, parks, scenic drives</p>
                </div>

                <div class="flex flex-col items-center p-4 border-4 border-sky-700 rounded-lg shadow text-center">
                    <i class="fa-solid fa-landmark text-3xl mb-2 text-[#BB6653]"></i>
                    <h3 class="font-semibold">Cultural</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-200">Temples, castles, museums</p>
                </div>

                <div class="flex flex-col items-center p-4 border-4 border-sky-700 rounded-lg shadow text-center">
                    <i class="fa-solid fa-utensils text-3xl mb-2 text-[#FF8040]"></i>
                    <h3 class="font-semibold">Foodie</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-200">Local cuisine, Michelin restaurants</p>
                </div>

                <div class="flex flex-col items-center p-4 border-4 border-sky-700 rounded-lg shadow text-center">
                    <i class="fa-solid fa-bag-shopping text-3xl mb-2 text-[#B9375D]"></i>
                    <h3 class="font-semibold">Shopping</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-200">Cities, outlets, duty-free</p>
                </div>

                <div class="flex flex-col items-center p-4 border-4 border-sky-700 rounded-lg shadow text-center">
                    <i class="fa-solid fa-microphone text-3xl mb-2 text-[#00809D]"></i>
                    <h3 class="font-semibold">Fan Travel</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-200">Anime, idol pilgrimage</p>
                </div>

                <div class="flex flex-col items-center p-4 border-4 border-sky-700 rounded-lg shadow text-center">
                    <i class="fa-solid fa-tractor text-3xl mb-2 text-[#386641]"></i>
                    <h3 class="font-semibold">Rural</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-200">Farming, countryside stays</p>
                </div>

                <div class="flex flex-col items-center p-4 border-4 border-sky-700 rounded-lg shadow text-center">
                    <i class="fa-solid fa-crown text-3xl mb-2 text-[#D3AF37]"></i>
                    <h3 class="font-semibold">Luxury</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-200">High-end resorts, villas</p>
                </div>

                <div class="flex flex-col items-center p-4 border-4 border-sky-700 rounded-lg shadow text-center">
                    <i class="fa-solid fa-wallet text-3xl mb-2 text-[#A2AF9B]"></i>
                    <h3 class="font-semibold">Budget</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-200">Guesthouses, capsule hotels</p>
                </div>

                <div class="flex flex-col items-center p-4 border-4 border-sky-700 rounded-lg shadow text-center">
                    <i class="fa-solid fa-leaf text-3xl mb-2 text-[#08CB00]"></i>
                    <h3 class="font-semibold">Sustainable</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-200">Eco-friendly, local support</p>
                </div>

                <div class="flex flex-col items-center p-4 border-4 border-sky-700 rounded-lg shadow text-center">
                    <i class="fa-solid fa-laptop-house text-3xl mb-2 text-[#4D2D8C]"></i>
                    <h3 class="font-semibold">Workation</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-200">Work & travel combined</p>
                </div>

                <div class="flex flex-col items-center p-4 border-4 border-sky-700 rounded-lg shadow text-center">
                    <i class="fa-solid fa-map text-3xl mb-2 text-[#E43636]"></i>
                    <h3 class="font-semibold">Spontaneous</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-200">Go with the flow</p>
                </div>

                <div class="flex flex-col items-center p-4 border-4 border-sky-700 rounded-lg shadow text-center">
                    <i class="fa-solid fa-plane-departure text-3xl mb-2 text-[#3396D3]"></i>
                    <h3 class="font-semibold">Travel</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-200">Any journey you like</p>
                </div>

                <div class="flex flex-col items-center p-4 border-4 border-sky-700 rounded-lg shadow text-center">
                    <i class="fa-solid fa-camera-retro text-3xl mb-2 text-[#0D1164]"></i>
                    <h3 class="font-semibold">Scenic</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-200">Beautiful drives, views</p>
                </div>
            </div>
        </section>
    </div>

    <div class="w-full dark:text-white mt-16">
        <!-- how to screen shot -- tittle -->
        <x-title>
            {{ __('Find travel mate on same date, destination, and style') }}
        </x-title>
    </div>
    <section class="w-full mx-auto px-4 py-8 ">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <!-- 1 -->
            <div class="border-4 border-sky-700 rounded-lg overflow-hidden p-6 flex flex-col items-start">
                <h1 class="text-xl font-semibold text-orange-500 mb-4">Calender page</h1>
                <img src="/images/screenshot.calender.png" alt="screenshot1" class="w-full h-auto">
                <div class="p-4">
                    <p>・ Pick the dates you want to travel on the calendar, and a modal will pop up showing you a quick
                        preview of the plan.</p>
                    <p>・ If you click the modal, you'll jump to the full details page.</p>
                    <p>・ You can also search by country using the tabs at the top of the page.</p>
                </div>
            </div>

            <!-- 2 -->
            <div class="border-4 border-sky-700 rounded-lg overflow-hidden p-6 flex flex-col items-start">
                <h1 class="text-xl font-semibold text-orange-500 mb-4">Plan detail page</h1>
                <img src="/images/screenshot.plandetail.png" alt="screenshot2" class="w-full h-auto">
                <div class="p-4">
                    <p>・ On the detail page, you can check out the full schedule, descriptions, and all the little
                        details of the trip. You'll also see who's already joined.</p>
                    <p>・ If you like the plan, there are a few ways to show it:</p>
                    <div class="group w-12 p-2 transition relative dark:text-white">
                        <!-- ❤️ -->
                        <i
                            class="fa-solid fa-heart heart absolute top-4 right-4 text-2xl text-red-500 dark:text-red-200"></i>
                    </div>

                    <style>
                        @keyframes heartbeat {

                            0%,
                            100% {
                                transform: scale(1);
                            }

                            25% {
                                transform: scale(1.3);
                            }

                            50% {
                                transform: scale(0.9);
                            }

                            75% {
                                transform: scale(1.2);
                            }
                        }

                        .group:hover .heart {
                            animation: heartbeat 0.8s ease-in-out infinite;
                            color: #e965ca;
                            /* Hover red */
                        }
                    </style>
                    <p class="dark:text-white">____ Like→ "Give a like to the travel plans you love and keep them on your personal travel list!"</p>

                    <div class="group w-12 p-2 transition relative dark:text-gray-400">
                        <!-- 🚩 -->
                        <i
                            class="fa-solid fa-flag flag absolute top-4 right-4 text-2xl text-green-500 dark:text-green-200"></i>
                    </div>

                    <style class="dark:text-white">
                        @keyframes waveFlag {
                            0% {
                                transform: rotate(0deg) skewX(0deg);
                            }

                            25% {
                                transform: rotate(3deg) skewX(3deg);
                            }

                            50% {
                                transform: rotate(0deg) skewX(0deg);
                            }

                            75% {
                                transform: rotate(-3deg) skewX(-3deg);
                            }

                            100% {
                                transform: rotate(0deg) skewX(0deg);
                            }
                        }

                        .group:hover .flag {
                            animation: waveFlag 0.6s ease-in-out infinite;
                            transform-origin: left center;
                            color: #e5d81b;
                            /* Fix the pole side */
                            /* hover red */
                        }
                    </style>
                    <p>____Interested → The travel plans that catch your eye and check them out later at your own pace.”</p>
                    <p>・ And when you're ready, you can hit the Join Request button to apply to join the trip.</p>
                </div>
            </div>

            <!-- 3 -->
            <div class="border-4 border-sky-700 rounded-lg overflow-hidden p-6 flex flex-col items-start">
                <h1 class="text-xl font-semibold text-orange-500 mb-4">Profile page</h1>
                <img src="/images/profile.png" alt="screenshot3" class="w-full h-auto">
                <div class="p-4">
                    <p>・ Your profile is where you can share your interests, favorite travel spots, and memories so
                        other users can connect with you.</p>
                    <p>・ You've got four tabs to check out your plans:</p>
                    <p><i class="fa-solid fa-clipboard-check text-sky-500"></i> → plans you've made</p>
                    <p><i class="fa-solid fa-handshake-angle text-yellow-500"></i> → plans you've joined</p>
                    <p><i class="fa-solid fa-flag text-green-500"></i> → plans you marked as “Interested”</p>
                    <p><i class="fa-solid fa-heart text-red-500"></i> → plans you liked</p>
                    <p>・ Below that, there's a calendar to manage your own schedule.</p>
                    <p>・ At the bottom, you'll find a section to showcase your favorite items, with links to where you
                        can
                        buy them.</p>
                </div>
            </div>

            <!-- 4 -->
            <div class="border-4 border-sky-700 rounded-lg overflow-hidden p-6 flex flex-col items-start">
                <h1 class="text-xl font-semibold text-orange-500 mb-4">Chat page</h1>
                <img src="/images/screenshot.chat.png" alt="screenshot4" class="w-full h-auto">
                <div class="p-4">
                    <p>・ On the chat page, you can talk with other people about your travel plans.</p>
                    <p>・ It's the perfect place to coordinate trips and connect with fellow travelers.</p>
                </div>
            </div>
        </div>
    </section>

    <div class="w-full h-[60vh] bg-cover text-white flex flex-col justify-end mt-24 px-4 pb-8"
        style="background-image: url('/images/zousan.jpeg'); background-position: 40% 20%;">
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
            This platform is here to bring together planners and explorers, so you can create, share, and join trips
            that turn into lasting memories.
        </p>
        <p class="leading-relaxed mb-2 text-sm md:text-base">
            And the best part? It's free.
        </p>
        <!-- button（right side） -->
        <div class="flex justify-end w-full mt-4">
            <x-primary-button class="ml-3">
                <a href="{{ route('register') }}">
                    {{ __('Join Now') }}
                </a>
            </x-primary-button>
        </div>
    </div>

    {{-- about us --}}
    <section id="about" class="w-full bg-gray-50 dark:bg-gray-800 text-gray-700 dark:text-white mt-24 px-6 py-12">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-400 mb-4">About Us</h2>
        <p class="text-gray-600 dark:text-white leading-relaxed mb-2">We're travelers, just like you.</p>
        <p class="text-gray-600 dark:text-white leading-relaxed mb-2">Sometimes we love planning every detail,<br>
            and sometimes we just want to hop on someone else's trip.</p>
        <p class="text-gray-600 dark:text-white leading-relaxed">That's why we built this space—to make it easier to
            find buddies, share
            ideas, and enjoy the journey together.</p>
    </section>

    <section class="max-w-4xl mx-auto my-4 p-4">
        <!-- big square -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 w-full mt-8 text-gray-700 dark:text-white">

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
                    <p class="ms-4">I hope this site will help people who usually travel alone and are looking for
                        someone to share experiences with. I also hope it will be useful for us in finding new job
                        opportunities.</p>
                </div>
                <div class="items-baseline">
                    <p class="underline decoration-orange-300 decoration-2 mr-2">Why I made it:</p>
                    <p class="ms-4"> First of all, we share a common passion — traveling abroad. That’s why we decided
                        to make travel the main focus of our app. With this app, people can search for travel buddies
                        who have similar travel styles and preferences. One of us once had a difficult experience while
                        traveling with a friend, which inspired us to include a feature that allows users to filter
                        potential buddies by their travel preferences. We hope this function will be helpful.</p>
                </div>
                <div class="items-baseline">
                    <p class="underline decoration-orange-300 decoration-2 mr-2">Contact:</p>
                    <p>instagram @imnotmvrk_</p>
                </div>
            </div>

            <!-- member 2 -->
            <div
                class="w-full border-8 border-sky-700 rounded-lg overflow-hidden p-6 flex flex-col items-start whitespace-normal break-words">
                <div class="flex items-center mb-2">
                    <img src="/images/aboutus_jojohayato.png" alt="Member 2" class="w-30 h-28 mr-3">
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
                    <p class="ms-4">We sincerely hope that this app will not only make your travel experiences wonderful
                        but also help you discover new places, connect with people, and create memorable moments along
                        the way. Our wish is that it becomes a companion that makes every journey, big or small, more
                        enjoyable and meaningful.</p>
                </div>
                <div class="items-baseline">
                    <p class="underline decoration-orange-300 decoration-2 mr-2">Why I made it:</p>
                    <p class="ms-4"> The main reason we created this app is simple: every member of our team has a deep
                        love for “travel.” We believe that traveling opens doors to new cultures, fresh perspectives,
                        and unforgettable stories. With that passion in mind, we wanted to build a tool that makes it
                        easier for fellow travelers to plan, share, and enjoy their journeys to the fullest.</p>
                </div>
                <div class="items-baseline">
                    <p class="underline decoration-orange-300 decoration-2 mr-2">Contact:</p>
                    <p>Instagram:https://www.instagram.com/hayato.moo/</p>
                </div>
            </div>

            <!-- member 3 -->
            <div
                class="w-full h-300 border-8 border-sky-700 rounded-lg overflow-hidden p-6 flex flex-col items-start whitespace-normal break-words">
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
                    <p class="flex items-center"><img src="/images/dragon.png" alt="kiwi" class="w-6 h-6 mr-3">Vietnam
                    </p>
                </div>
                <div class="items-baseline">
                    <p class="underline decoration-orange-300 decoration-2 mr-2">Why this site matters:</p>
                    <p class="ms-4">If you feel like traveling, that's the perfect time to go. Follow your heart and
                        enjoy the journey!</p>
                </div>
                <div class="items-baseline">
                    <p class="underline decoration-orange-300 decoration-2 mr-2">Why I made it:</p>
                    <p class="ms-4">Traveling is way more fun with people who get your vive-that's why I made this site!
                    </p>
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
                    <p><i class="fa-solid fa-shrimp mr-2"></i>Shrimp & Muscat & Xiao long bao</p>
                </div>
                <div class="items-baseline">
                    <p class="underline decoration-orange-300 decoration-2 mr-2">Favorite Country:</p>
                    <p class="flex items-center"><img src="/images/sharingan_kiwi.png" alt="kiwi"
                            class="w-6 h-6 mr-3">Australia</p>
                </div>
                <div class="items-baseline">
                    <p class="underline decoration-orange-300 decoration-2 mr-2">Why this site matters:</p>
                    <p class="ms-4">I wanted to create a space where people can easily connect, share ideas, and travel
                        together.</p>
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