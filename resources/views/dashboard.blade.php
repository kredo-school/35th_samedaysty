<x-app-layout>
    <x-title name="header">
        {{ __('Home') }}
    </x-title>
    <div class="flex items-center justify-end">
        <!-- buttons for each plan -->
        <div class="flex text-lg mb-1 text-gray-500 my-2">
            <button onclick="document.getElementById('requested-plansModal').showModal()" class="px-4 hover:text-gray-800">
                <i class="fa-solid fa-person-praying text-indigo-500 me-1"></i>requested&nbsp;{{ Auth::user()->requestedPlans()->count() }}
            </button>
            <button onclick="document.getElementById('travel-plansModal').showModal()" class="px-4 hover:text-gray-800">
                <i class="fa-solid fa-clipboard-check text-teal-500 me-1"></i>created&nbsp;{{ Auth::user()->travelPlans()->count() }}
            </button>
            <button onclick="document.getElementById('joined-plansModal').showModal()" class="px-4 hover:text-gray-800">
                <i class="fa-solid fa-handshake text-yellow-500 me-1"></i>joined&nbsp;{{ Auth::user()->joinedPlans()->count() }}
            </button>
            <button onclick="document.getElementById('interested-plansModal').showModal()" class="px-4 hover:text-gray-800">
                <i class="fa-solid fa-flag text-green-500 me-1"></i>interested&nbsp;{{ Auth::user()->interestedPlans()->count() }}
            </button>
            <button onclick="document.getElementById('liked-plansModal').showModal()" class="px-4 hover:text-gray-800">
                <i class="fa-solid fa-heart text-red-500 me-1"></i>liked&nbsp;{{ Auth::user()->likedPlans()->count() }}
            </button>
        </div>

        <!-- modals -->
        <x-plan-modal title="Requested Plans" :plans="Auth::user()->requestedPlans" />
        <x-plan-modal title="Travel Plans" :plans="Auth::user()->travelPlans" />
        <x-plan-modal title="Joined Plans" :plans="Auth::user()->joinedPlans" />
        <x-plan-modal title="Interested Plans" :plans="Auth::user()->interestedPlans" />
        <x-plan-modal title="Liked Plans" :plans="Auth::user()->likedPlans" />
    </div>

    <div class="flex"></div>
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
<!--my create & joined plan-->
    @if(Auth::check())
        <h1 class="text-2xl p-5 mt-5">My Travel Calendar (Joined & Created) </h1>
        <div class="w-full">
            <div class="mb-6">
                <x-calendar endpoint="/plan/my/all" />
            </div>
        </div>
        @endif
</x-app-layout>