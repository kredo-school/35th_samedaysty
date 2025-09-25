<x-app-layout>
    <x-title name="header">
        {{ __('Home') }}
    </x-title>

    <!--add user icon,created,joined,interested,liked!!!!!!!!!!!!!!!!!!!!! -->


    <div class="h-screen bg-cover bg-center shadow-lg" style="background-image: url('/images/airplane.png')">
        <div class="flex items-center justify-center h-full w-full p-10">
            <!-- Centering -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 w-full max-w-5xl h-full">
                <!--search others travel plans-->
                <a href="{{ route('plan.search') }}"
                    class="w-full h-full relative bg-white/5 text-white font-bold rounded-lg flex items-center justify-center text-4xl hover:bg-white/40 border border-transparent transition px-2 py-3">
                    <i class="fa-solid fa-hippo text-3xl sm:text-4xl md:text-5xl mb-2"></i>
                    <span class="text-center leading-tight">Search others<br>travel plans</span>
                </a>

                <!--create your travel plan-->
                <a href="{{ route('plan.create') }}"
                    class="w-full h-full relative bg-white/5 text-white font-bold rounded-lg flex items-center justify-center text-4xl hover:bg-white/40 border border-transparent transition px-2 py-3">
                    <i class="fa-solid fa-plane text-3xl sm:text-4xl md:text-5xl mb-2"></i>
                    <span class="text-center leading-tight">Create your<br>travel plan</span>
                </a>

                <!--profile-->
                <a href="{{ route('profile.show',Auth::id()) }}"
                    class="w-full h-full relative bg-white/5 text-white font-bold rounded-lg flex items-center justify-center text-4xl hover:bg-white/40 border border-transparent transition px-2 py-3">
                    <i class="fa-solid fa-user text-3xl sm:text-4xl md:text-5xl mb-2"></i>
                    <span>Profile</span>
                </a>

                <!--chat-->
                <a href="{{ route('chat.index') }}"
                    class="w-full h-full relative bg-white/5 text-white font-bold rounded-lg flex items-center justify-center text-4xl hover:bg-white/40 border border-transparent transition px-2 py-3">
                    <i class="fa-solid fa-comments text-3xl sm:text-4xl md:text-5xl mb-2"></i>
                    <span>Chat page</span>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>