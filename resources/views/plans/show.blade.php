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
            @can('view_own', $travel_plan)
            <a href="{{ route('plan.edit', $travel_plan->id) }}">
                <x-primary-button>edit</x-primary-button>
            </a>

            <form action="{{ route('plan.delete', $travel_plan->id) }}" method="POST"
                onsubmit="return confirm('Are you sure you want to delete this plan?');">
                @csrf
                @method('DELETE')
                <x-danger-button>
                    {{ __('Delete') }}
                </x-danger-button>
            </form>
            @endcan
        </div>

        <!-- plan details -->
        <div class="pt-3 flex items-center">
            <a href="{{ route('profile.show', $travel_plan->user->id)}}">{!! $travel_plan->user->avatar ? '<img
                    src="' . $travel_plan->user->avatar . '" alt="avatar" class="w-10 h-10 rounded-full">' : '<i
                    class="fa-solid fa-circle-user text-gray-500 text-5xl"></i>' !!}</a>
            <h4 class="text-xl ps-2">{{ $travel_plan->user->name }}</h4>
            <h4 class="text-xl ms-auto px-2">{{ $travel_plan->country->name }}</h4>
            <i class="fi fi-{{ $travel_plan->country->code }} text-3xl"></i>
        </div>

        <div class="px-8 pt-4">
            <!-- plan style -->
            <div class="flex pt-5 items-center font-bold">
                <h4 class="text-xl py-1">Style&nbsp;:</h4>
                <ul class="flex flex-wrap gap-2">
                    @forelse($travel_plan->travelStyles as $style)
                    <li class="flex items-center px-2 py-1 bg-sky-200 rounded">
                        <i class="{{ $style->fontawesome_icon }} mr-2"></i>
                        {{ $style->display_name }}
                    </li>
                    @empty
                    <li class="text-gray-500 italic">No styles selected</li>
                    @endforelse
                </ul>
            </div>

                <!-- plan name -->
                <div class="flex pt-5 items-center font-bold">
                    <h4 class="text-xl">Plan&nbsp;:</h4>
                    <p class="text-xl ms-2">{{$travel_plan->title}}</p>
                </div>

                <!-- description -->
                <div class="flex pt-5 items-start">
                    <h4 class="text-xl font-bold">description&nbsp;:</h4>
                    <p class="text-base ms-2">{{ $travel_plan->description }}</p>
                </div>

                <!-- date -->
                <div class="flex pt-5 items-center">
                    <h4 class="text-xl font-bold">date&nbsp;:</h4>
                    <p class="text-base ms-2">{{ $travel_plan->start_date }}</p>
                    <p class="text-base mx-2">-</p>
                    <p class="text-base">{{ $travel_plan->end_date }}</p>
                </div>

                <!-- max participants -->
                <div class="flex pt-1 items-center">
                    <h4 class="text-xl font-bold">Max&nbsp;:</h4>
                    <p class="text-base ms-2">{{ $travel_plan->max_participants }}</p>
                    <p class="text-base ms-1">people</p>
                </div>

                <!-- like/interested/join buttons -->
                <div class="flex justify-end space-x-5 py-2 items-center">
                    <form action="{{ route('reaction.store', $travel_plan->id) }}" method="POST" class="flex gap-4">
                        @csrf
                        <input type="hidden" name="plan_id" value="{{ $travel_plan->id }}">

                        <button type="submit" name="type" value="like">
                            <i
                                class="fa-{{ $travel_plan->isReacted('like') ? 'solid' : 'regular' }} fa-heart text-red-500 text-3xl">
                            </i>
                            <span class="text-2xl ms-1">like</span>
                            <span class="text-md ms-1">{{ $travel_plan->isReacted('like') }}</span>
                        </button>

                        <button type="submit" name="type" value="interested">
                            <i
                                class="fa-{{ $travel_plan->isReacted('interested') ? 'solid' : 'regular' }} fa-flag text-green-500 text-3xl"></i>
                            <span class="text-2xl ms-1">interested</span>
                            <span class="text-md ms-1">{{ $travel_plan->isReacted('interested') }}</span>
                        </button>

                    </form>
                    @cannot('view_own', $travel_plan)
                        <form action="{{ route('participations.store') }}" method="post">
                            @csrf
                            <input type="hidden" name="travel_plan_id" value="{{ $travel_plan->id }}">
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
                @can('view_own', $travel_plan)
                <div class="flex justify-end">
                    <div class="bg-gray-200 w-1/2 shadow-md rounded-lg p-2">
                        <h2 class="text-xl font-semibold mb-4 text-center">join requests</h2>
                        @forelse($travel_plan->pendingParticipations as $pending)
                        <!-- icon/name/time + buttons -->
                        <div class="flex items-center">
                            <!-- leftside: user info -->
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('profile.show', $pending->user->id) }}">{!! $pending->user->avatar ?
                                    '<img src="' . $pending->user->avatar . '" alt="avatar"
                                        class="w-10 h-10 rounded-full">' :
                                    '<i class="fa-solid fa-circle-user text-gray-500 text-3xl"></i>' !!}</a>
                                <div class="flex flex-col">
                                    <span class="font-semibold">{{ $pending->user->name }}</span>
                                    <span class="text-sm text-gray-500">{{ $pending->created_at->diffForHumans()
                                        }}</span>
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
            </div>

        <!-- stepper -->
        @if($travel_plan->user->id !== Auth::id())
            <x-stepper :status="$status"></x-stepper>
        @endif

        <!-- participants chat -->
        @canany(['view_own', 'participate'], $travel_plan)
            <div class="border-4 border-sky-300 box-border rounded-md mt-3 overflow-y-auto">
                <div class="flex items-center">
                    <h4 class="text-xl text-sky-500 font-bold mx-auto">participants chat</h4>
                    <div class="flex space-x-2 ml-4">
                            <span class="py-1 text-gray-400">{{ $travel_plan->user->name }},</span>
                        @forelse($travel_plan->participations as $participation)
                            <span class="py-1 text-gray-400">{{ $participation->user->name }},</span>
                        @empty
                        <p>no other participnts yet</p>
                        @endforelse
                    </div>
                </div>
                @forelse($travel_plan->participant_chats as $participant_chat)
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
                    <a href="{{ route('profile.show', $participant_chat->user->id) }}">{!!
                        $participant_chat->user->avatar ?
                        '<img src="' . $participant_chat->user->avatar . '" alt="avatar"
                            class="w-10 h-10 rounded-full">' :
                        '<i class="fa-solid fa-circle-user text-gray-500 text-3xl"></i>' !!}</a>
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
                    <form action="{{ route('participant_chat.store', $travel_plan->id) }}" method="post"
                        class="w-full flex gap-2">
                        @csrf
                        <input type="text" name="participant_chat_body{{ $travel_plan->id }}" id=""
                            placeholder="message..."
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
                @foreach($travel_plan->comments as $comment)
                <div class="flex items-center space-x-3 p-4">
                    <!-- icon -->
                    <a href="{{ route('profile.show', $comment->user->id) }}">{!! $comment->user->avatar ? '<img
                            src="' . $comment->user->avatar . '" alt="avatar" class="w-10 h-10 rounded-full">' : '<i
                            class="fa-solid fa-circle-user text-gray-500 text-3xl"></i>' !!}</a>

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
                    <form action="{{ route('comment.store', $travel_plan->id) }}" method="post"
                        class="w-full flex gap-2">
                        @csrf
                        <input type="text" name="comment_body{{ $travel_plan->id }}" id="" placeholder="comment..."
                            class="flex-1 min-w-0 border border-gray-300 rounded-full px-4 py-2 focus:outline-none focus:ring-2">
                        <!-- <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-full flex-shrink-0">send</button> -->
                        <button type="submit" class="flex-shrink-0"><img src="\images\send-message.png" alt=""></button>
                    </form>
                </div>
            </div>
        </div>
</x-app-layout>