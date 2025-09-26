<x-app-layout>
    <div class="max-w-lg mx-auto mt-10 bg-white p-6 rounded shadow">
        <h1 class="text-xl font-bold mb-4">Delete Plan</h1>
        <p class="mb-6">Are you sure you want to delete the plan:
            <strong>{{ $plan->title }}</strong>?
        </p>

        <div class="flex space-x-4">
            <!-- Submit Button (Delete)-->
            <div class="text-center mb-6">
                <form action="{{ route('plan.delete', $plan->id) }}" method="POST"
                    onsubmit="return confirm('Are you sure you want to delete this plan?');">
                    @csrf
                    @method('DELETE')
                    <x-danger-button>
                        {{ __('Delete') }}
                    </x-danger-button>
                </form>

                <a href="{{ route('plan.detail', $plan->id) }}" class="bg-gray-300 px-4 py-2 rounded">
                    Cancel
                </a>

            </div>
        </div>
    </div>
</x-app-layout>