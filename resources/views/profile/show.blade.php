<x-app-layout>
    {{-- @var \App\Models\User $user --}}
    <!--header profile-->
    <div class="">
        <x-title name="header">
            {{ __('Profile') }}
        </x-title>
    </div>
    <!--avatar -->
    <div class="items-start space-x-8 p-4">
        <div class="flex flex-col md:flex-row items-start md:items-center space-y-6 md:space-y-0 md:space-x-8 p-4">
            <div class="flex-none w-1/5">
                <div class="w-36 h-36 rounded-full bg-white flex items-center justify-center border border-orange-500 overflow-hidden">
                    @if($user->avatar)
                    <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" class="w-full h-full rounded-full object-cover">
                    @else
                    <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                        <i class="fa-solid fa-hippo text-gray-400 text-6xl"></i>
                    </div>
                    @endif
                </div>
            </div>
            <!--user info-->
            <div class="flex-1 w-4/5 flex flex-col justify-center">
                <h3 class="text-lg  sm:text-2xl md:text-3xl font-bold">{{ $user->name }}</h3>
                <!--count-->
                <div class="mt-4 flex space-x-6">
                    <div class="flex items-center space-x-3">
                        <span class="text-gray-500">Posts</span>
                        <span class="font-bold">{{ $postsCount }}</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <span class=" text-gray-500">Following</span>
                        <span class="font-bold">{{ $postsCount }}</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <span class=" text-gray-500">Followers</span>
                        <span class="font-bold" id="followers-count-{{ $user->id }}">{{ $followersCount }}</span>
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
                    <a href="{{ route('profile.edit') }}"
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
                    @if(Auth::id() !== $user->id)

                    <div id="follow-btn-{{ $user->id }}">
                        @php
                        $followAction = $isFollowing ? 'unfollow' : 'follow';
                        @endphp

                        <button
                            id="follow-button-{{ $user->id }}"
                            class="px-4 py-2 rounded text-white {{ $isFollowing ? 'bg-red-500 hover:bg-red-600' : 'bg-blue-500 hover:bg-blue-600' }}"
                            onclick="toggleFollow('{{ $user->id }}', '{{ $followAction }}')">
                            {{ $isFollowing ? 'Unfollow' : 'Follow' }}
                        </button>
                    </div>

                    @endif
                    <a href=""
                        class="px-4 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-600 transition">
                        Chat
                    </a>
                    @endif
                </div>
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

    </div>

    <!--show gadgets -->
    @forelse($gadgets as $gadget)
    <div class="w-full flex items-center m-2">
        <!-- image -->
        <div class="flex-none w-32 h-32 mb-2">
            @if($gadget->photo_url && file_exists(storage_path('app/public/' . $gadget->photo_url)))
            <img src="{{ asset('storage/' . $gadget->photo_url) }}"
                alt="{{ $gadget->item_name }}"
                class="w-32 h-32 rounded-full object-cover border">
            @else
            <img src="{{ asset('images/airplane.png') }}"
                alt="Sample"
                class="w-32 h-32 rounded-full object-cover border">
            @endif
        </div>

        <!-- item info -->
        <div class="flex-1 w-6/10 p-2">
            <h3 class="text-lg sm:text-2xl md:text-3xl font-bold">{{ $gadget->item_name }}</h3>

            <!-- description -->
            <div class="mt-4 space-y-4">
                <div class="flex items-center space-x-3">
                    <p>{{ Str::limit($gadget->memo, 100) }}</p>
                    @if(strlen($gadget->memo) > 100)
                    <x-secondary-button>read more...</x-secondary-button>
                    @endif
                </div>

                @if($gadget->shop_url)
                <div class="flex items-center space-x-2">
                    <i class="fa-solid fa-link text-blue-800"></i>
                    <a href="{{ $gadget->shop_url }}"
                        target="_blank"
                        class="text-blue-600 underline">
                        {{ $gadget->shop_url }}
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
    @empty
    <p class="p-5 text-gray-600">I'm trying to figure out which one is better.
    </p>
    @endforelse

    <!-- ajax part -->
    <script>
        function toggleFollow(userId, action) {
            // action change URL
            const url = action === 'follow' ?
                `/follow/${userId}` :
                `/unfollow/${userId}`;

            fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        action
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const btnDiv = document.getElementById(`follow-btn-${userId}`);
                        const followersCountEl = document.getElementById(`followers-count-${userId}`);

                        if (data.action === 'followed') {
                            btnDiv.innerHTML = `
                    <button 
                        id="follow-button-${userId}"
                        class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600"
                        onclick="toggleFollow(${userId}, 'unfollow')">
                        Unfollow
                    </button>`;
                        } else if (data.action === 'unfollowed') {
                            btnDiv.innerHTML = `
                    <button 
                        id="follow-button-${userId}"
                        class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600"
                        onclick="toggleFollow(${userId}, 'follow')">
                        Follow
                    </button>`;
                        }

                        // follower change from controller
                        if (followersCountEl) {
                            followersCountEl.textContent = data.followers_count;
                        }
                    }
                })
                .catch(err => console.error('Error:', err));
        }
    </script>
</x-app-layout>