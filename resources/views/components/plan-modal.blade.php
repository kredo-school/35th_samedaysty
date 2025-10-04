@props(['title', 'plans'])

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
        @forelse($plans as $plan)
            <div class="bg-gray-100 dark:bg-gray-800 p-3 rounded-lg">
                <h3 class="font-semibold text-gray-800 dark:text-gray-200 mb-1">
                    {{ $plan->country->name ?? 'Unknown Country' }}
                </h3>
                <a href="{{ route('plan.show', $plan->id) }}" class="text-sky-600 hover:underline">
                    {{ $plan->title }}
                </a>
            </div>
        @empty
            <p class="text-gray-500">No plans found.</p>
        @endforelse
    </div>
</dialog>