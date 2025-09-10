<x-app-layout>
    <x-title name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-title>

    <!--add user icon,created,joined,interested,liked!!!!!!!!!!!!!!!!!!!!! -->

    <div class="py-12">
        <div class="w-full">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm">
                <div class="h-screen bg-cover bg-center shadow-lg"
                    style="background-image: url('/images/airplane.png')">
                    <div class="grid grid-cols-2 grid-rows-2 h-full w-full gap-10 p-10">
                        <!--find others travel plans-->
                        <a class="w-full h-full relative bg-white/5 text-white font-bold rounded-lg flex items-center justify-center text-4xl hover:bg-white/40 border border-transparent hover:border-orange-500 transition px-2 py-3">
                            <i class="fa-solid fa-hippo flex-none text-3xl m-2"></i>
                            <span class="leading-none">Find others<br>travel plans</span>
                        </a>
                        <!--create your travel plan-->
                        <a class="w-full h-full relative bg-white/5 text-white font-bold rounded-lg flex items-center justify-center text-4xl hover:bg-white/40 border border-transparent hover:border-orange-500 transition px-2 py-3">
                            <i class="fa-solid fa-plane flex-none text-3xl m-2"></i>
                            <span class="leading-none">Create your<br>travel plan</span>
                        </a>
                        <!--profile-->
                        <a class="w-full h-full relative bg-white/5  text-white font-bold rounded-lg flex items-center justify-center text-4xl hover:bg-white/40 border border-transparent hover:border-orange-500 transition">
                            <i class="fa-solid fa-user text-3xl m-2"></i>
                            <span>Profile</span>
                        </a>
                        <!--chat-->
                        <a class="w-full h-full relative bg-white/5  text-white font-bold rounded-lg flex items-center justify-center text-4xl hover:bg-white/40 border border-transparent hover:border-orange-500 transition">
                            <i class="fa-solid fa-comments flex-none text-3xl m-2"></i>
                            <span class="">Chat page</span>
                        </a>
                    </div>
                </div>   
            </div>
        </div>
    </div>
</x-app-layout>
