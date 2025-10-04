<x-app-layout>
    <!-- heading -->
    <x-title>
        Plan details
    </x-title>

    @if(session('success'))
    <div class="max-w-4xl mx-auto mt-4 p-4 bg-green-50 border border-green-300 text-green-800 rounded-lg shadow">
        <p class="font-semibold">✅ Success</p>
        <p>{{ session('success') }}</p>
    </div>
    @endif

    <div class="px-20">
        <!-- edit/delete buttons -->
        <div class="flex justify-end space-x-2 py-2">
            @can('view_own', $plan)
            <a href="{{ route('plan.edit', $plan->id) }}">
                <x-primary-button>edit</x-primary-button>
            </a>

            <form action="{{ route('plan.delete', $plan->id) }}" method="POST"
                onsubmit="return confirm('Are you sure you want to delete this plan?');">
                @csrf
                @method('DELETE')
                <x-danger-button>
                    {{ __('Delete') }}
                </x-danger-button>
            </form>
            @endcan
        </div>

        <!-- Map section -->
        <div class="w-full mb-6">
            <x-map :country="$plan->country" :plan-title="$plan->title" />
        </div>

        <!-- plan details -->
        <div class="pt-3 flex items-center">
            @canany(['view_own', 'participate'], $plan)
            <a href="{{ route('profile.show', $plan->user->id)}}" class="flex-shrink-0">
                <div class="w-10 h-10 rounded-full overflow-hidden">
                    @if($plan->user->avatar)
                    <img src="{{ asset('storage/' . $plan->user->avatar) }}" alt="avatar"
                        class="w-full h-full object-cover">
                    @else
                    <div
                        class="w-full h-full bg-gradient-to-br from-blue-400 to-purple-500 flex items-center justify-center">
                        <span class="text-white text-lg font-bold">{{ strtoupper(substr($plan->user->name, 0, 1))
                            }}</span>
                    </div>
                    @endif
                </div>
            </a>
            <h4 class="text-xl ps-2">{{ $plan->user->name }}</h4>
            @else
            <img src="/images/kinoko_mori.png" alt="" class="w-10 h-10 rounded-full overflow-hidden">
            <h4 class="text-xl ps-2">Plan Owner</h4>
            <p class="text-sm text-gray-400 ms-2">only participants can see owner's profile</p>
            @endcanany
            <h4 class="text-xl ms-auto px-2">{{ $plan->country->name }}</h4>
            <i class="fi fi-{{ $plan->country->code }} text-3xl"></i>
        </div>

        <div class="px-8 pt-4">
            <!-- plan style -->
            <div class="flex pt-5 items-center font-bold">
                <h4 class="text-xl py-1">Style&nbsp;:</h4>
                <ul class="flex flex-wrap gap-2">
                    @forelse($plan->planStyles as $planStyle)
                    <li class="flex items-center px-2 py-1 bg-sky-200 rounded">
                        <i class="{{ $planStyle->travelStyle->fontawesome_icon }} mr-2"></i>
                        {{ $planStyle->travelStyle->display_name }}
                    </li>
                    @empty
                    <li class="text-gray-500 italic">No styles selected</li>
                    @endforelse
                </ul>
            </div>

            <!-- plan name -->
            <div class="flex pt-5 items-center font-bold">
                <h4 class="text-xl">Plan&nbsp;:</h4>
                <p class="text-xl ms-2">{{$plan->title}}</p>
            </div>

            <!-- description -->
            <div class="flex pt-5 items-start">
                <h4 class="text-xl font-bold">description&nbsp;:</h4>
                <p class="text-base ms-2">{{ $plan->description }}</p>
            </div>

            <!-- date -->
            <div class="flex pt-5 items-center">
                <h4 class="text-xl font-bold">date&nbsp;:</h4>
                <p class="text-base ms-2">{{ $plan->start_date }}</p>
                <p class="text-base mx-2">-</p>
                <p class="text-base">{{ $plan->end_date }}</p>
            </div>

            <!-- max participants -->
            <div class="flex pt-1 items-center">
                <h4 class="text-xl font-bold">Max&nbsp;:</h4>
                <p class="text-base ms-2">{{ $plan->participants()->count() }}</p>
                <p class="text-base ms-2">/&nbsp;{{ $plan->max_participants }}</p>
                <p class="text-base ms-2">people</p>
            </div>

            <!-- like/interested buttons -->
            <div class="flex justify-end space-x-5 py-2 items-center">
                <div x-data="{
                    openLike: false,
                    openInterested: false,

                    liked: {{ $plan->isReacted('like') ? 'true' : 'false' }},
                    interested: {{ $plan->isReacted('interested') ? 'true' : 'false' }},

                    likeCount: {{ $plan->reactions()->where('type', 'like')->count() }},
                    interestedCount: {{ $plan->reactions()->where('type', 'interested')->count() }},
                    }" class="flex gap-4">
                    <!-- like button -->
                    <button type="button" @click="
                            fetch('{{ route('reaction.store', $plan->id) }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                },
                                body: JSON.stringify({ plan_id: {{ $plan->id }}, type: 'like' })
                            })
                            .then(res => res.json())
                            .then(data => {
                                if (data.status === 'added') {
                                    liked = true;
                                    likeCount++;
                                } else if (data.status === 'removed') {
                                    liked = false;
                                    likeCount--;
                                }

                                const icon = $el.querySelector('i');
                                icon.classList.add('scale-125');
                                setTimeout(() => icon.classList.remove('scale-125'), 200);
                            })
                            .catch(err => console.error(err))
                        " class="flex items-center gap-2 transition transform duration-300 hover:scale-110">
                        <i :class="liked ? 'fa-solid fa-heart text-red-500' : 'fa-regular fa-heart text-red-500'"
                            class="text-3xl transition-transform duration-300"></i>
                    </button>
                    <span class="text-xl font-medium">like</span>
                    <!-- modal button -->
                    <button @click="openLike = true" class="text-md text-gray-600" type="button" x-text="likeCount">
                        <!-- {{ $plan->reactions()->where('type', 'like')->count() }} -->
                    </button>
                    <!-- interested button -->
                    <button type="button" @click="
                            fetch('{{ route('reaction.store', $plan->id) }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                },
                                body: JSON.stringify({ plan_id: {{ $plan->id }}, type: 'interested' })
                            })
                            .then(res => res.json())
                            .then(data => {
                                if (data.status === 'added') {
                                    interested = true;
                                    interestedCount++;
                                } else if (data.status === 'removed') {
                                    interested = false;
                                    interestedCount--;
                                }

                                const icon = $el.querySelector('i');
                                icon.classList.add('scale-125');
                                setTimeout(() => icon.classList.remove('scale-125'), 200);
                            })
                            .catch(err => console.error(err));
                        " class="flex items-center gap-2 transition transform duration-300 hover:scale-110">
                        <i :class="interested ? 'fa-solid fa-flag text-green-500' : 'fa-regular fa-flag text-green-500'"
                            class="text-3xl transition-all duration-300"></i>
                    </button>
                    <span class="text-xl font-medium">interested</span>

                    <!-- modal button -->
                    <button @click="openInterested = true" class="text-md text-gray-600" type="button"
                        x-text="interestedCount">
                        <!-- {{ $plan->reactions()->where('type', 'interested')->count() }} -->
                    </button>

                    <!-- Like Modal -->
                    <div x-show="openLike" x-transition x-cloak
                        class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50"
                        style="display: none;">
                        <div class="bg-white rounded-lg shadow-lg w-1/3 p-6">
                            <h2 class="text-lg font-bold mb-4">Likes</h2>
                            <ul class="divide-y max-h-60 overflow-y-auto">
                                @foreach($plan->reactions()->where('type', 'like')->with('user')->get() as $reaction)
                                <li class="py-2">{{ $reaction->user->name }}</li>
                                @endforeach
                            </ul>

                            <div class="flex justify-end mt-4">
                                <button @click="openLike = false" class="px-4 py-2 bg-gray-500 text-white rounded-lg">
                                    close
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Interested Modal -->
                    <div x-show="openInterested" x-transition x-cloak
                        class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50"
                        style="display: none;">
                        <div class="bg-white rounded-lg shadow-lg w-1/3 p-6">
                            <h2 class="text-lg font-bold mb-4">Interested</h2>
                            <ul class="divide-y max-h-60 overflow-y-auto">
                                @foreach($plan->reactions()->where('type', 'interested')->with('user')->get() as $reaction)
                                <li class="py-2">{{ $reaction->user->name }}</li>
                                @endforeach
                            </ul>

                            <div class="flex justify-end mt-4">
                                <button @click="openInterested = false"
                                    class="px-4 py-2 bg-gray-500 text-white rounded-lg">
                                    close
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- join button -->
                @cannot('view_own', $plan)
                <form action="{{ route('participations.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="travel_plan_id" value="{{ $plan->id }}">
                    @switch($status)
                    @case('pending')
                    <x-secondary-button type="submit" disabled class="ms-4">REQUESTED</x-secondary-button>
                    @break
                    @case('accepted')
                    <x-secondary-button type="submit" disabled class="ms-4">JOINED</x-secondary-button>
                    @break
                    @case('declined')
                    <x-secondary-button type="submit" disabled class="ms-4">DECLINED</x-secondary-button>
                    @break
                    @default
                    <x-secondary-button type="submit" class="ms-4">JOIN</x-secondary-button>
                    @endswitch
                </form>
                @endcan
            </div>

            <!-- approve join request -->
            @can('view_own', $plan)
            <div class="flex justify-end">
                <div class="bg-gray-200 w-1/2 shadow-md rounded-lg p-2">
                    <h2 class="text-xl font-semibold mb-4 text-center">join requests</h2>
                    @forelse($plan->pendingParticipations as $pending)
                    <!-- icon/name/time + buttons -->
                    <div class="flex items-center">
                        <!-- leftside: user info -->
                        <div class="flex items-center space-x-2">
                            <a href="{{ route('profile.show', $pending->user->id) }}" class="flex-shrink-0">
                                <div class="w-10 h-10 rounded-full overflow-hidden">
                                    @if($pending->user->avatar)
                                    <img src="{{ asset('storage/' . $pending->user->avatar) }}" alt="avatar"
                                        class="w-full h-full object-cover">
                                    @else
                                    <div
                                        class="w-full h-full bg-gradient-to-br from-blue-400 to-purple-500 flex items-center justify-center">
                                        <span class="text-white text-lg font-bold">{{
                                            strtoupper(substr($pending->user->name, 0, 1)) }}</span>
                                    </div>
                                    @endif
                                </div>
                            </a>
                            <div class="flex flex-col">
                                <span class="font-semibold">{{ $pending->user->name }}</span>
                                <span class="text-sm text-gray-500">{{ $pending->created_at->diffForHumans() }}</span>
                            </div>
                        </div>

                        <!-- rightside： buttons -->
                        <div class="flex space-x-2 ml-auto">
                            <!-- accept -->
                            <form action="{{ route('participations.update', $pending->id) }}" method="POST"
                                class="inline">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="accepted">
                                <button type="submit" class="px-3 py-1 bg-green-500 text-white rounded">
                                    Accept
                                </button>
                            </form>

                            <!-- decline -->
                            <form action="{{ route('participations.update', $pending->id) }}" method="POST"
                                class="inline">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="declined">
                                <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded">
                                    Decline
                                </button>
                            </form>
                        </div>
                    </div>
                    @empty
                    <p>No join requests yet.</p>
                    @endforelse
                </div>
            </div>
            @endcan

            <!-- stepper -->
            @if($plan->user->id !== Auth::id())
            <x-stepper :status="$status"></x-stepper>
            @endif

            <!-- participants chat -->
            @canany(['view_own', 'participate'], $plan)
            <div class="border-4 border-sky-300 box-border rounded-md mt-3 overflow-y-auto">
                <div class="flex items-center">
                    <h4 class="text-xl text-sky-500 font-bold ms-2 me-auto">participants chat</h4>
                    <div class="flex space-x-1 ml-4">
                        <a href="{{ route('profile.show', $plan->user->id)}}"
                            class="inline-flex items-center px-3 py-1 text-sm font-medium text-white bg-orange-500 rounded-full mt-1">{{
                            $plan->user->name }}</a>
                        @php
                        $acceptedParticipations = $plan->participations->where('status', 'accepted');
                        @endphp
                        @forelse($acceptedParticipations as $participation)
                        <a href="{{ route('profile.show', $participation->user->id)}}"
                            class="inline-flex items-center px-3 py-1 text-sm font-medium text-white bg-sky-600 rounded-full mt-1">{{
                            $participation->user->name }}</a>
                        @empty
                        <p>no other participants yet</p>
                        @endforelse
                    </div>
                </div>
                @forelse($plan->participant_chats as $participant_chat)
                @if($participant_chat->user->id === Auth::user()->id)
                <!-- own message -->
                <div class="flex justify-end items-start gap-2 p-3">
                    <div class="flex items-end justify-end gap-1">
                        <!-- time/content -->
                        <span class="text-xs text-gray-500">{{ $participant_chat->created_at->diffForHumans() }}</span>
                        <div class="bg-orange-500 text-white rounded-2xl rounded-tr-none p-3 text-sm break-words">
                            {{ $participant_chat->body }}
                        </div>
                    </div>
                </div>
                @else
                <!-- others' message -->
                <div class="flex items-start gap-2 p-3">
                    <!-- icon -->
                    <a href="{{ route('profile.show', $participant_chat->user->id) }}" class="flex-shrink-0">
                        <div class="w-10 h-10 rounded-full overflow-hidden">
                            @if($participant_chat->user->avatar)
                            <img src="{{ asset('storage/' . $participant_chat->user->avatar) }}" alt="avatar"
                                class="w-full h-full object-cover">
                            @else
                            <div
                                class="w-full h-full bg-gradient-to-br from-blue-400 to-purple-500 flex items-center justify-center">
                                <span class="text-white text-lg font-bold">{{
                                    strtoupper(substr($participant_chat->user->name, 0, 1)) }}</span>
                            </div>
                            @endif
                        </div>
                    </a>
                    <div>
                        <!-- username -->
                        <span class="text-xs text-gray-500">{{ $participant_chat->user->name }}</span>

                        <!-- chat content/time -->
                        <div class="flex items-end gap-1">
                            <div class="bg-gray-200 rounded-2xl rounded-tl-none p-3 break-words">
                                {{ $participant_chat->body }}
                            </div>
                            <div class="text-xs text-gray-500">{{ $participant_chat->created_at->diffForHumans() }}
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @empty
                <p class="text-gray-500 p-4">no message yet</p>
                @endforelse

                <div class="border-t border-gray-300 p-3 flex gap-2">
                    <form action="{{ route('participant_chat.store', $plan->id) }}" method="post"
                        class="w-full flex gap-2">
                        @csrf
                        <input type="text" name="participant_chat_body{{ $plan->id }}" id="" placeholder="message..."
                            class="flex-1 min-w-0 border border-gray-300 rounded-full px-4 py-2 focus:outline-none focus:ring-2">
                        <!-- <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-full flex-shrink-0">send</button> -->
                        <button type="submit" class="flex-shrink-0"><img src="\images\send-message.png" alt=""></button>
                    </form>
                </div>
            </div>
            @endcanany

            <!-- comment -->
            <div class="border border-black box-border rounded-md my-5 overflow-y-auto">
                <h4 class="text-xl font-bold ms-3">comments</h4>
                @foreach($plan->comments as $comment)
                <div class="flex items-center space-x-3 p-4">
                    <!-- icon -->
                    <a href="{{ route('profile.show', $comment->user->id) }}" class="flex-shrink-0">
                        <div class="w-10 h-10 rounded-full overflow-hidden">
                            @if($comment->user->avatar)
                            <img src="{{ asset('storage/' . $comment->user->avatar) }}" alt="avatar"
                                class="w-full h-full object-cover">
                            @else
                            <div
                                class="w-full h-full bg-gradient-to-br from-blue-400 to-purple-500 flex items-center justify-center">
                                <span class="text-white text-lg font-bold">{{ strtoupper(substr($comment->user->name, 0,
                                    1)) }}</span>
                            </div>
                            @endif
                        </div>
                    </a>

                    <div class="flex flex-col justify-center">
                        <!-- name/time -->
                        <div class="flex items-center space-x-2">
                            <span class="font-semibold">{{ $comment->user->name }}</span>
                            <span class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                        </div>

                        <!-- comment content -->
                        <p class="text-gray-700">
                            {{ $comment->body }}
                        </p>
                    </div>
                </div>
                @endforeach

                <div class="border-t border-gray-300 p-3 flex gap-2">
                    <form action="{{ route('comment.store', $plan->id) }}" method="post" class="w-full flex gap-2">
                        @csrf
                        <input type="text" name="comment_body{{ $plan->id }}" id="" placeholder="comment..."
                            class="flex-1 min-w-0 border border-gray-300 rounded-full px-4 py-2 focus:outline-none focus:ring-2">
                        <!-- <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-full flex-shrink-0">send</button> -->
                        <button type="submit" class="flex-shrink-0"><img src="\images\send-message.png" alt=""></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>