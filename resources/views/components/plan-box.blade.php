<div>
    <!-- title -->
    @props(['title', 'plans', 'total' => null, 'all' => null])
    @php
    $titleParts = explode(' ', $title, 2);
    $icons = [
    'Created' => 'fa-solid fa-clipboard-check text-teal-500',
    'Joined' => 'fa-solid fa-handshake text-yellow-500',
    'Interested' => 'fa-solid fa-flag text-green-500',
    'Liked' => 'fa-solid fa-heart text-red-500',
    ];
    $icon = $icons[$titleParts[0]] ?? 'fa-solid fa-folder text-gray-400';
    @endphp

    <div class="bg-white dark:bg-gray-700 p-4 rounded-lg border flex flex-col min-h-[280px]">
        <div class="flex-1">
            <h2 class="text-lg font-bold mb-2 flex items-center space-x-2">
                <i class="{{ $icon }} text-2xl"></i>
                @if(!empty($parts) && is_array($parts) && count($parts) > 1)
                <span class="text-orange-500">{{ $parts[0] }}</span>
                <span class="text-sky-700">{{ $parts[1] }}</span>
                @else
                <span class="text-sky-700">{{ $title }}</span>
                @endif

            </h2>
            <p class="text-xs text-gray-400">
                {{ $title }}: {{ $total ?? $plans->count() }} plans found
            </p>

            <!-- plan list -->
            <div class="space-y-4">
                @forelse($plans->take(2) as $plan)
                <div class="bg-gray-100 dark:bg-gray-800 p-3 rounded-lg">
                    <div class="flex items-center gap-x-2 mb-1">
                        @if(!empty($plan->country->code))
                        <i class="fi fi-{{ strtolower($plan->country->code) }} text-xl"></i>
                        @else
                        <i class="fa-solid fa-earth-americas text-gray-400 text-xl"></i>
                        @endif
                        <h3 class="font-semibold text-gray-800 dark:text-gray-200">
                            {{ $plan->country->name ?? 'Unknown Country' }}
                        </h3>
                    </div>
                    <a href="{{ route('plan.show', $plan->id) }}"
                        class="block text-sky-600 hover:underline text-base font-medium mt-1">
                        {{ $plan->title }}
                    </a>
                </div>
                @empty
                <div class="flex items-center justify-center h-24 text-gray-500">
                    No {{ strtolower($title) }} yet.
                </div>
                @endforelse
            </div>
        </div>

        <!-- show all button -->
        <div class="mt-auto text-right h-8">
            @if(($total ?? $plans->count()) > 2)
            <div class="mt-3 text-right">
                <button type="button"
                    onclick="document.getElementById('{{ \Illuminate\Support\Str::slug($title) }}Modal').showModal()"
                    class="text-sky-600 hover:underline">
                    Show all {{ strtolower($title) }} →
                </button>
            </div>
            @endif
        </div>
    </div>

    <!-- modal-->
    <x-plan-modal :title="$title" :plans="$all ?? $plans" />

</div>