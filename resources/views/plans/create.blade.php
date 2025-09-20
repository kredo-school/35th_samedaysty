<x-app-layout>
    <div class="w-full px-30">
        <x-slot name="header">
            <h1 class="text-2xl md:text-3xl lg:text-4xl text-center">
                <span class="font-bold text-orange-500">CREATE</span>
                <span class="font-bold text-sky-700">&nbsp;PLAN</span>
            </h1>
        </x-slot>

        <form action="{{ route('plan.store') }}" method="POST"
            class="p-6 px-12 max-w-7xl mx-auto bg-white rounded-lg mt-6">
            @csrf

            <!-- Avatar + Name -->
            <div class="flex items-center justify-start space-x-2 mb-16">
                <img src="/images/bellman.png" alt="Avatar" class="w-10 h-10 rounded-full">
                <h1 class="text-2xl md:text-3xl lg:text-4xl text-center">
                    <span class="ml-2 font-bold text-gray-800">{{ $plan->user->name ?? 'User' }}</span>
                </h1>
            </div>

            <!-- Travel Style -->
            <div class="mb-6">
                <h2 class="font-semibold mb-4">Travel Style</h2>

                <!-- 5rows -->
                <div class="grid grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($travel_styles as $style)
                    <!-- card 1 -->
                    <label
                        class="border rounded-lg p-3 cursor-pointer hover:bg-gray-50 flex flex-col justify-between h-18">

                        <!-- UpperRow ：checkbox ＋Logo ＋Name -->
                        <div class="flex items-center space-x-2">
                            <input type="checkbox" name="travel_styles[]" value="{{ $style->id }}"
                                class="h-4 w-4 text-blue-600 flex-shrink-0">

                            <i class="{{ $style->fontawesome_icon }} text-xl flex-shrink-0"></i>

                            <h3 class="font-semibold text-sm truncate">{{ ucfirst($style->style_name) }}</h3>
                        </div>

                        <!-- LowerRow ：Description -->
                        <p class="text-xs text-gray-600 mt-2 truncate">
                            {{ $style->description ?? 'No description yet' }}
                        </p>
                    </label>
                    @endforeach
                </div>
            </div>
            <!-- Title と Country -->
            <div class="flex mb-6 space-x-4">
                <div class="flex-1">
                    <label class="block mb-1 font-semibold text-sm">Title</label>
                    <input type="text" name="title" class="w-full border rounded-lg p-2">
                </div>
                <div class="flex-1">
                    <label class="block mb-1 font-semibold text-sm">Country</label>
                    <x-country-select name="country_id" class="w-full" />
                </div>
            </div>

            <!-- Description -->
            <div class="mb-6">
                <label class="block mb-1 font-semibold text-sm">Description</label>
                <textarea name="description" rows="4" class="w-full border rounded-lg p-2"></textarea>
            </div>

            <!-- Plan Date -->
            <div class="flex mb-6 space-x-4">
                <div class="flex-1">
                    <label class="block mb-1 font-semibold text-sm">From</label>
                    <input type="date" name="start_date" class="w-full border rounded-lg p-2">
                </div>
                <div class="flex-1">
                    <label class="block mb-1 font-semibold text-sm">To</label>
                    <input type="date" name="end_date" class="w-full border rounded-lg p-2">
                </div>
            </div>

            <!-- Max Participants -->
            <div class="mb-6">
                <label class="block mb-1 font-semibold text-sm">Max Participants</label>
                <input type="number" name="max_participants" class="w-full border rounded-lg p-2">
            </div>

            <!-- Submit Button -->
            <div class="text-center">
                <button type="submit"
                    class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 px-6 rounded-full">
                    Create Plan
                </button>
            </div>

            @if(session('success'))
            <div
                class="mt-4 max-w-2xl mx-auto p-4 bg-green-50 border border-green-300 text-green-800 rounded-lg shadow">
                <p class="font-semibold">✅ Success</p>
                <p>{{ session('success') }}</p>
            </div>
            @endif
        </form>
    </div>
</x-app-layout>