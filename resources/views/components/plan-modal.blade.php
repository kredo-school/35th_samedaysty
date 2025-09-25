@props(['plans', 'title', 'routePrefix', 'idSuffix'])

<dialog id="plansModal{{ $idSuffix }}" class="rounded-lg p-6 w-3/4 max-w-2xl">
    <h2 class="text-lg font-bold mb-4">All {{ $title }}</h2>
    <div class="space-y-4 max-h-96 overflow-y-auto">
        @foreach($plans as $plan)
        <div class="bg-gray-100 dark:bg-gray-800 p-3 rounded-lg">
            <h3 class="font-semibold text-gray-800 dark:text-gray-200 mb-1">
                {{ $plan->country->name ?? 'Unknown Country' }}
            </h3>
            <span class="text-gray-600 dark:text-gray-500 text-sm">
                Plan <a href="{{ route($routePrefix.'.detail', $plan->id) }}"
                        class="text-sky-600 hover:underline">
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
