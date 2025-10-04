<div>
    <!-- title -->
    @props(['title', 'plans'])
    @php
    $parts = explode(' ', $title, 2); // ["Created", "Plans"]
    $icons = [
    'Created' => 'fa-solid fa-clipboard-check text-teal-500',
    'Joined' => 'fa-solid fa-handshake text-yellow-500',
    'Interested' => 'fa-solid fa-flag text-green-500',
    'Liked' => 'fa-solid fa-heart text-red-500',
    ];

    $icon = $icons[$parts[0]] ?? 'fa-solid fa-folder text-gray-400';
    @endphp

    <div class="bg-white dark:bg-gray-700 p-4 rounded-lg border">
        <h2 class="text-lg font-bold mb-2 flex items-center space-x-2">
            <i class="{{ $icon }} text-2xl"></i>
            <span class="text-orange-500">{{ $parts[0] ?? '' }}</span>
            <span class="text-sky-700">{{ $parts[1] ?? '' }}</span>
        </h2>

        <!-- plan -->
        <div class="space-y-4">
            @forelse($plans->take(2) as $plan)
            <div class="bg-gray-100 dark:bg-gray-800 p-3 rounded-lg">
                <h3 class="font-semibold text-gray-800 dark:text-gray-200 mb-1">
                    {{ $plan->country->name ?? 'Unknown Country' }}
                </h3>
                <a href="{{ route('plan.show', $plan->id) }}" class="text-sky-600 hover:underline">
                    {{ $plan->title }}
                </a>
            </div>
            @empty
            <p class="text-gray-500">No {{ strtolower($title) }} yet.</p>
            @endforelse
        </div>

        <!-- Show all button -->
        @if($plans->count() > 2)
        <div class="mt-3 text-right">
            <button type="button"
                onclick="document.getElementById('{{ \Illuminate\Support\Str::slug($title) }}Modal').showModal()"
                class="text-sky-600 hover:underline">
                Show all {{ strtolower($title) }} →
            </button>
        </div>
        @endif
    </div>

    <!-- modal -->
    <dialog id="{{ \Illuminate\Support\Str::slug($title) }}Modal" class="rounded-lg p-6 w-3/4 max-w-2xl">
        <!-- header -->
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-bold">All {{ $title }}</h2>
            <form method="dialog">
                <button class="text-gray-400 hover:text-gray-600 text-5xl">&times;</button>
            </form>
        </div>

        <!-- plan list -->
        <div class="space-y-4 max-h-96 overflow-y-auto">
            @foreach($plans as $plan)
            <div class="bg-gray-100 dark:bg-gray-800 p-3 rounded-lg">
                <h3 class="font-semibold text-gray-800 dark:text-gray-200 mb-1">
                    {{ $plan->country->name ?? 'Unknown Country' }}
                </h3>
                <a href="{{ route('plan.show', $plan->id) }}" class="text-sky-600 hover:underline">
                    {{ $plan->title }}
                </a>
            </div>
            @endforeach
        </div>
    </dialog>
</div>