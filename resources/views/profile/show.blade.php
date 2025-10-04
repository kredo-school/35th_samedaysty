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
                <div
                    class="w-36 h-36 rounded-full bg-white flex items-center justify-center border border-orange-500 overflow-hidden">
                    @if($user->avatar)
                    <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar"
                        class="w-full h-full rounded-full object-cover">
                    @else
                    <div
                        class="w-full h-full bg-gradient-to-br from-blue-400 to-purple-500 flex items-center justify-center">
                        <span class="text-white text-5xl font-bold">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
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
                        <button onclick="showFollowModal('{{ route('users.following.json', $user->id) }}', 'Following')"
                            class="font-bold text-rose-500 hover:underline">
                            {{ $followingCount }}
                        </button>
                    </div>
                    <div class="flex items-center space-x-3">
                        <span class="text-gray-500">Followers</span>
                        <button onclick="showFollowModal('{{ route('users.followers.json', $user->id) }}', 'Followers')"
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
                <!--only see own user-->
                <div class="flex space-x-4 mt-4">
                    @if(Auth::id() === $user->id)
                    <!--only see own user-->
                    <a href="{{ route('profile.edit') }}"
                        class="w-32 px-4 py-2 text-white bg-zinc-500 rounded-md border-2 border-transparent hover:bg-white hover:text-zinc-500 hover:border-zinc-500 hover:border-2 transition inline-flex items-center justify-center text-sm font-semibold tracking-widest font-ubuntu focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-white">
                        Edit profile
                    </a>
                    <a href="#"
                        class="w-32 px-4 py-2 text-white bg-zinc-500 rounded-md border-2 border-transparent hover:bg-white hover:text-zinc-500 hover:border-zinc-500 hover:border-2 transition inline-flex items-center justify-center text-sm font-semibold tracking-widest font-ubuntu focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Share profile
                    </a>
                    @if(Auth::id() === $user->id)
                    <div class="flex items-center space-x-3 font-ubuntu">
                        <form action="{{ route('profile.toggleStatus') }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="w-32 px-4 py-2 text-white bg-orange-500 rounded-md border-2 border-transparent hover:bg-white hover:text-orange-500 hover:border-orange-500 transition inline-flex items-center justify-center text-sm font-semibold font-ubuntu focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                {{ $user->status === 'public' ? 'Switch to Private' : 'Switch to Public' }}
                            </button>
                        </form>

                        <span class="w-32 px-4 py-2 rounded-md border-2 inline-flex items-center justify-center text-sm font-semibold tracking-widest font-ubuntu  {{ $user->status === 'public' ? 'bg-lime-500 text-white' : 'bg-pink-400 text-white' }}">
                            Status: {{ ucfirst($user->status) }}
                        </span>
                    </div>
                    @endif
                    <!--pending list-->
                    @if(Auth::id() === $user->id)
                    <x-secondary-button onclick="document.getElementById('pendingModal').showModal()">
                        Pending Requests ({{ $user->followerRequests->count() }})
                    </x-secondary-button>
                    @endif

                    <!--pending list Modal-->
                    <dialog id="pendingModal" class="rounded-lg p-6 w-3/4 max-w-md">
                        <h2 class="text-lg font-bold mb-4">Follow Requests</h2>
                        <div class="space-y-4 max-h-80 overflow-y-auto">
                            @forelse($user->followerRequests as $request)
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <img src="{{ $request->follower->avatar ? asset('storage/' . $request->follower->avatar) : asset('images/default-avatar.png') }}" class="w-10 h-10 rounded-full object-cover">
                                    <a href="{{ route('profile.show', $request->follower->id) }}"
                                        class="text-blue-600 focus:outline-none focus:ring-0">
                                        {{ $request->follower->name }}
                                    </a>
                                </div>
                                <div class="space-x-2">
                                    <form action="{{ route('follow.approve', $request->id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        <button class="px-3 py-1 bg-sky-500 text-white rounded hover:bg-green-600">
                                            Approve
                                        </button>
                                    </form>
                                    <form action="{{ route('follow.reject', $request->id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        <button class="px-3 py-1 bg-red-500 text-white rounded hover:bg-yellow-500">
                                            Reject
                                        </button>
                                    </form>
                                </div>
                            </div>
                            @empty
                            <p class="text-gray-500">No pending requests.</p>
                            @endforelse
                        </div>

                        <form method="dialog" class="mt-4 text-right">
                            <button class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition">
                                Close
                            </button>
                        </form>
                    </dialog>

                    @else
                    <!--other user-->
                    @if(Auth::id() !== $user->id)
                    <div id="follow-btn-{{ $user->id }}">
                        @php $me = Auth::user(); @endphp

                        @if($me->isFollowing($user))
                        <!--approve-->
                        <button id="follow-button-{{ $user->id }}"
                            class="px-4 py-2 rounded text-white bg-red-500 hover:bg-red-600"
                            onclick="toggleFollow('{{ $user->id }}', 'unfollow')">
                            Following
                        </button>

                        @elseif($me->isPending($user))
                        <!--sent request-->
                        <button id="follow-button-{{ $user->id }}"
                            class="px-4 py-2 rounded text-white bg-gray-400 cursor-not-allowed" disabled>
                            Request Sent
                        </button>

                        @else
                        <!--not follow-->
                        <button id="follow-button-{{ $user->id }}"
                            class="px-4 py-2 rounded text-white bg-blue-500 hover:bg-blue-600"
                            onclick="toggleFollow('{{ $user->id }}', 'follow')">
                            Follow
                        </button>
                        @endif
                    </div>

                    @endif
                    <a href="" class="px-4 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-600 transition">
                        Chat
                    </a>
                    @endif
                </div>
            </div>
        </div>

        <!--Travel plans-->
        <h1 class="text-2xl p-5">Travel Plans</h1>
        <div class="px-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!--login user-->
                @if(Auth::id() === $user->id)
                <x-plan-box title="Created Plan" :plans="$travelPlans" />
                <x-plan-box title="Joined Plan" :plans="$joinedPlan" />
                <x-plan-box title="Interested Plan" :plans="$latestInterestedPlans" />
                <x-plan-box title="Liked Plans" :plans="$latestLikedPlans" />
                <!--follow user status:public-->
                @elseif($user->status === 'public' && Auth::user()->isFollowing($user))
                <x-plan-box title="Interested Plans" :plans="$interestedPlans" />
                <x-plan-box title="Liked Plans" :plans="$likedPlans" />
                <!-- unfollower and status:private -->
                @else
                @if($user->status === 'private')
                    <p class="text-gray-500">These travel plans are under lock and key. Even followers don't get the spare key.</p>
                    @elseif(!$user->followers->contains(Auth::id()))
                        <p class="text-gray-500">Follow this user and see what they're up to! (Some secrets may stay hidden)</p>
                    @endif
                @endif
            </div>
        </div>

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
                    <img src="{{ asset('storage/' . $gadget->photo_url) }}" alt="{{ $gadget->item_name }}"
                        class="w-32 h-32 rounded-lg object-cover border">
                    @else
                    <img src="{{ asset('images/airplane.png') }}" alt="Sample"
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
        <p class="text-center text-gray-500 p-5">
            Only followers can view travel plans.
        </p>

        <!-- ajax part -->
        <script>
            function toggleFollow(userId, action) {
                const url = action === 'follow' ? `/follow/${userId}/request` :
                    `/unfollow/${userId}`;

                fetch(url, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        console.log(data);
                        if (data.success) {
                            const btn = document.getElementById(`follow-button-${userId}`);
                            if (data.status === 'pending') {
                                btn.textContent = "Request Sent";
                                btn.className = "px-4 py-2 rounded text-white bg-gray-400 cursor-not-allowed";
                                btn.disabled = true;
                            } else if (data.action === 'unfollowed') {
                                btn.textContent = "Follow";
                                btn.className = "px-4 py-2 rounded text-white bg-blue-500 hover:bg-blue-600";
                                btn.disabled = false;
                                btn.setAttribute("onclick", `toggleFollow('${userId}', 'follow')`);
                            }
                        }
                    });
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