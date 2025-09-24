<x-app-layout>
    {{-- @var \App\Models\User $user --}}
    <!--header profile-->
    <div class="max-w-full overflow-x-hidden">
        <div class="px-4 py-2">
            <x-title name="header">
                {{ __('Profile') }}
            </x-title>
        </div>
        <!--avatar -->
        <div class="flex flex-col md:flex-row items-start md:items-center space-y-6 md:space-y-0 md:space-x-8 px-4">
            <div class="flex-none w-36">
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
            <div class="flex-1 min-w-0 flex-col">
                <h3 class="text-lg  sm:text-2xl md:text-3xl font-bold">{{ $user->name }}</h3>
                <!--count-->
                <div class="mt-4 flex space-x-6">
                    <div class="flex items-center space-x-3">
                        <span class="text-gray-500">Posts</span>
                        <span class="font-bold text-teal-500">{{ $postsCount }}</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <span class="text-gray-500">Following</span>
                        <button
                            onclick="showFollowModal('{{ route('users.following.json', $user->id) }}', 'Following')"
                            class="font-bold text-rose-500 hover:underline">
                            {{ $followingCount }}
                        </button>
                    </div>

                    <div class="flex items-center space-x-3">
                        <span class="text-gray-500">Followers</span>
                        <button
                            onclick="showFollowModal('{{ route('users.followers.json', $user->id) }}', 'Followers')"
                            class="font-bold text-fuchsia-600 hover:underline">
                            <span id="followers-count-{{ $user->id }}">{{ $followersCount }}</span>
                        </button>
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

        <!--Travel plans-->
        <h1 class="text-2xl p-5">Travel Plans</h1>
        <div class="px-4">
            <div class="min-h-auto bg-cover bg-center shadow p-4">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-6">
                    <!-- 1. Created Plans -->
                    <div class="bg-white dark:bg-gray-700 p-4 rounded-lg border">
                        <h2 class="text-lg font-bold mb-2"><i class="fa-solid fa-clipboard-check text-teal-500 text-2xl mr-2"></i>
                            <span class="text-orange-500">CREATED </span>
                            <span class="text-sky-700">Plans</span>
                        </h2>
                        <div class="space-y-4">
                            @forelse($travelPlans->take(2) as $plan)
                            <div class="bg-gray-100 dark:bg-gray-800 p-3 rounded-lg">
                                <h3 class="font-semibold text-gray-800 dark:text-gray-200 mb-1">{{ $plan->country->name ?? 'Unknown Country' }}</h3>
                                <span class="list-disc list-inside space-y-1 text-gray-600 dark:text-gray-500 text-sm">
                                    Plan <a href="{{ route('plan.detail', $plan->id) }}"
                                        class="text-sky-600 hover:underline">
                                        {{ $plan->title }}
                                    </a>
                                </span>
                            </div>
                            @empty
                            <p class="text-gray-500 text-sm">No travel plans yet.</p>
                            @endforelse
                        </div>
                        @if($travelPlans->count() > 2)
                        <div class="mt-3">
                            <x-plan-modal :plans="$travelPlans->skip(2)" title="Created Plans" routePrefix="plan" idSuffix="Created" />
                            <x-primary-button type="button" onclick="document.getElementById('plansModal').showModal()">
                                Show all plans
                            </x-primary-button>
                        </div>
                        @endif
                    </div>
                    <!-- Modal for Created Plans -->
                    <dialog id="plansModal" class="rounded-lg p-6 w-3/4 max-w-2xl">
                        <h2 class="text-lg font-bold mb-4">All Created Plans</h2>
                        <div class="space-y-4 max-h-96 overflow-y-auto"> @foreach($travelPlans as $plan) <div class="bg-gray-100 dark:bg-gray-800 p-3 rounded-lg">
                                <h3 class="font-semibold text-gray-800 dark:text-gray-200 mb-1"> {{ $plan->country->name ?? 'Unknown Country' }} </h3> <span class="text-gray-600 dark:text-gray-500 text-sm"> Plan <a href="{{ route('plan.detail', $plan->id) }}" class="text-sky-600 hover:underline"> {{ $plan->title }} </a> </span>
                            </div> @endforeach </div>
                        <form method="dialog" class="mt-4 text-right"> <button class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition"> Close </button> </form>
                    </dialog>

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
                        <h2 class="text-lg font-bold mb-2">
                            <i class="fa-solid fa-flag text-green-500 text-2xl mr-2"></i>
                            <span class="text-orange-500">INTERESTED </span>
                            <span class="text-sky-700">Plans</span>
                        </h2>

                        <div class="space-y-4">
                            @forelse($latestInterestedPlans as $plan)
                            <div class="bg-gray-100 dark:bg-gray-800 p-3 rounded-lg">
                                <h3 class="font-semibold text-gray-800 dark:text-gray-200 mb-1">
                                    {{ $plan->country->name ?? 'Unknown Country' }}
                                </h3>
                                <span class="text-gray-600 dark:text-gray-500 text-sm">
                                    Plan:
                                    <a href="{{ route('plan.detail', $plan->id) }}" class="text-sky-600 hover:underline">
                                        {{ $plan->title }}
                                    </a>
                                </span>
                            </div>
                            @empty
                            <p class="text-gray-500 text-sm">No interested plans yet.</p>
                            @endforelse
                        </div>

                        @if($remainingInterestedPlans->count() > 0)
                        <div class="mt-3">
                            <x-primary-button type="button" onclick="document.getElementById('interestedModal').showModal()">
                                Show all plans
                            </x-primary-button>
                        </div>
                        @endif
                    </div>
                    <!-- Modal for remaining Interested plans -->
                    <dialog id="interestedModal" class="rounded-lg p-6 w-3/4 max-w-2xl">
                        <h2 class="text-lg font-bold mb-4">All Interested Plans</h2>
                        <div class="space-y-4 max-h-96 overflow-y-auto">
                            @foreach($remainingInterestedPlans as $plan)
                            <div class="bg-gray-100 dark:bg-gray-800 p-3 rounded-lg">
                                <h3 class="font-semibold text-gray-800 dark:text-gray-200 mb-1">
                                    {{ $plan->country->name ?? 'Unknown Country' }}
                                </h3>
                                <span class="text-gray-600 dark:text-gray-500 text-sm">
                                    Plan:
                                    <a href="{{ route('plan.detail', $plan->id) }}" class="text-sky-600 hover:underline">
                                        {{ $plan->title }}
                                    </a>
                                </span>
                            </div>
                            @endforeach
                        </div>
                        <form method="dialog" class="mt-4 text-right">
                            <button class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition">
                                Close
                            </button>
                        </form>
                    </dialog>

                    <!-- 4. Liked Plans -->
                    <div class="bg-white dark:bg-gray-700 p-4 rounded-lg border">
                        <h2 class="text-lg font-bold mb-2"><i class="fa-solid fa-heart text-red-500 text-2xl mr-2"></i>
                            <span class="text-orange-500">LIKED </span>
                            <span class="text-sky-700">Plans</span>
                        </h2>

                        <div class="space-y-4">
                            @forelse($latestLikedPlans as $plan)
                            <div class="bg-gray-100 dark:bg-gray-800 p-3 rounded-lg">
                                <h3 class="font-semibold text-gray-800 dark:text-gray-200 mb-1">{{ $plan->country->name ?? 'Unknown Country' }}</h3>
                                <span class="list-disc list-inside space-y-1 text-gray-600 dark:text-gray-500 text-sm">
                                    <a href="{{ route('plan.detail', $plan->id) }}" class="text-sky-600 hover:underline">
                                        {{ $plan->title }}
                                    </a>
                                </span>
                            </div>
                            @empty
                            <p class="text-gray-500 text-sm">No liked plans yet.</p>
                            @endforelse
                        </div>
                        @if($remainingLikedPlans->count() > 0)
                        <div class="mt-3">
                            <x-primary-button type="button" onclick="document.getElementById('likedModal').showModal()">
                                Show all plans
                            </x-primary-button>
                        </div>
                        @endif
                    </div>
                    <!-- Modal for remaining liked plans -->
                    <dialog id="likedModal" class="rounded-lg p-6 w-3/4 max-w-2xl">
                        <h2 class="text-lg font-bold mb-4">All Liked Plans</h2>
                        <div class="space-y-4 max-h-96 overflow-y-auto">
                            @foreach($remainingLikedPlans as $plan)
                            <div class="bg-gray-100 dark:bg-gray-800 p-3 rounded-lg">
                                <h3 class="font-semibold text-gray-800 dark:text-gray-200 mb-1">
                                    {{ $plan->country->name ?? 'Unknown Country' }}
                                </h3>
                                <span class="text-gray-600 dark:text-gray-500 text-sm">
                                    Plan: <a href="{{ route('plan.detail', $plan->id) }}" class="text-sky-600 hover:underline">
                                        {{ $plan->title }}
                                    </a>
                                </span>
                            </div>
                            @endforeach
                        </div>
                        <form method="dialog" class="mt-4 text-right">
                            <button class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition">
                                Close
                            </button>
                        </form>
                    </dialog>
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
    <h1 class="text-2xl p-5">3 essentials for my travel <span class="text-orange-500">style</span></h1>
    <div class="p-4 space-y-4">
        @forelse($gadgets as $gadget)
        <div class="flex flex-col lg:flex-row lg:items-center gap-4 max-w-full overflow-hidden">

            <!-- gadgets image -->
            <div class="flex-none w-32 h-32">
                @if($gadget->photo_url && file_exists(storage_path('app/public/' . $gadget->photo_url)))
                <img src="{{ asset('storage/' . $gadget->photo_url) }}"
                    alt="{{ $gadget->item_name }}"
                    class="w-32 h-32 rounded-lg object-cover border">
                @else
                <img src="{{ asset('images/airplane.png') }}"
                    alt="Sample"
                    class="w-32 h-32 rounded-lg object-cover border">
                @endif
            </div>

            <!-- gadgets info -->
            <div class="flex-1 min-w-0">
                <h3 class="text-lg sm:text-2xl md:text-3xl font-bold truncate">{{ $gadget->item_name }}</h3>
                <p class="mt-2 break-words">{{ $gadget->memo }}</p>

                @if($gadget->shop_url)
                <div class="flex items-center space-x-2 mt-2 break-words">
                    <i class="fa-solid fa-link text-blue-800"></i>
                    <a href="{{ $gadget->shop_url }}" target="_blank" class="text-blue-600 underline">
                        {{ $gadget->shop_url }}
                    </a>
                </div>
                @endif
            </div>
        </div>
        @empty
        <p class="p-5 text-gray-600">I'm trying to figure out which one is better.</p>
        @endforelse
    </div>

    <!--　Follow/Followers Modal HTML -->
    <dialog id="followModal" class="rounded-lg p-6 w-3/4 max-w-md">
        <h2 id="followModalTitle" class="text-lg font-bold mb-4"></h2>
        <div id="followModalContent" class="space-y-2 max-h-80 overflow-y-auto">
            Loading...
        </div>
        <form method="dialog" class="mt-4 text-right">
            <button class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition">Close</button>
        </form>
    </dialog>


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

        function showFollowModal(url, title) {
            const modal = document.getElementById('followModal');
            const modalTitle = document.getElementById('followModalTitle');
            const modalContent = document.getElementById('followModalContent');

            modalTitle.textContent = title;
            modalContent.innerHTML = 'Loading...';

            fetch(url, {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    }
                })
                .then(res => {
                    if (!res.ok) throw new Error(`HTTP error! status: ${res.status}`);
                    return res.json();
                })
                .then(users => {
                    if (!users || users.length === 0) {
                        modalContent.innerHTML = `<p class="text-gray-500">No ${title.toLowerCase()} yet.</p>`;
                        return;
                    }

                    modalContent.innerHTML = users.map(user => {
                        const avatarUrl = user.avatar ? `/storage/${user.avatar}` : '/images/default-avatar.png';
                        return `
                        <div class="flex items-center space-x-3">
                            <img src="${avatarUrl}" class="w-10 h-10 rounded-full object-cover">
                            <a href="/profile/${user.id}" class="text-blue-600 hover:underline">${user.name}</a>
                        </div>
                    `;
                    }).join('');
                })
                .catch(err => {
                    console.error(err);
                    modalContent.innerHTML = '<p class="text-red-500">Failed to load data.</p>';
                });

            modal.showModal();
        }
    </script>
</x-app-layout>