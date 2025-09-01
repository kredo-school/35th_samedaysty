<x-app-layout>
    <x-title name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-title>

    <div class="py-12">
        <div class="w-full">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm">
                <div class="h-screen bg-cover bg-center shadow-lg"
                    style="background-image: url('/images/airplane.png')">
                    <div class="grid grid-cols-2 grid-rows-2 h-full w-full gap-20 p-20">
                        <!--find others travel plans-->
                            <button class="w-full h-full relative bg-white/5 text-white font-bold rounded-lg flex items-center justify-center text-2xl hover:bg-white/50 transition px-6 py-3">
                                Find others<br>travel plans
                                <!-- hippo -->
                                <i class="fa-solid fa-hippo absolute flex-none left-8 bottom-8 text-2xl"></i>
                            </button>
                        <!-- create your travel plan -->
                        <button 
                            x-data="{ flying: false }"
                            @click="flying = true"
                            class="w-full h-full relative bg-white/5 text-white font-bold rounded-lg px-3 py-3 text-2xl hover:bg-white/50 transition overflow-hidden">
                            Create your<br>travel plan
                            <!-- airplane -->
                            <i class="fa-solid fa-plane absolute left-6 bottom-6 text-2xl transition-transform duration-1000" :class="flying ? 'translate-x-[120%] -translate-y-24 rotate-12' : ''"></i>
                        </button>

                        <button class="w-full h-full relative bg-white/5  text-white font-bold rounded-lg flex items-center justify-center text-2xl hover:bg-white/50 transition">
                        Profile<i class="fa-solid fa-user absolute flex-none left-8 bottom-8 text-2xl"></i>
                        </button>
                        <button class="w-full h-full relative bg-white/5  text-white font-bold rounded-lg flex items-center justify-center text-2xl hover:bg-white/50 transition">
                        Chat page<i class="fa-solid fa-comments absolute flex-none left-8 bottom-8 text-2xl"></i>
                        </button>
                    </div>
                </div>   
            </div>
        </div>
    </div>
</x-app-layout>
