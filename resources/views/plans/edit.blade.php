<x-app-layout>
    <div class="w-full px-30">
        <x-slot name="header">
            <x-title>
                Edit plan
            </x-title>
        </x-slot>

        <form action="{{ route('plan.update', $plan->id) }}" method="POST"
            class="p-6 px-12 max-w-7xl mx-auto bg-white rounded-lg mt-6">
            @csrf
            @method('PUT') <!-- PUT METHOD -->


            <!-- Avatar + Name -->
            <div class="flex items-center justify-start space-x-2 mb-16">
                <img src="{{ $plan->user->avatar_url ?? '/images/default-avatar.png' }}" alt="Avatar"
                    class="w-10 h-10 rounded-full">
                <h1 class="text-2xl md:text-3xl lg:text-4xl text-center">
                    <span class="ml-2 font-bold text-gray-800">{{ $plan->user->name ?? 'User' }}</span>
                </h1>
            </div>

            <!-- Travel Style -->
            <div class="mb-6">
                <h2 class="font-semibold mb-4">Travel Style</h2>
                <div class="grid grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($travel_styles as $style)
                    <label
                        class="border rounded-lg p-3 cursor-pointer hover:bg-gray-50 flex flex-col justify-between h-18">
                        <div class="flex items-center space-x-2">
                            <input type="checkbox" name="travel_styles[]" value="{{ $style->id }}"
                                class="h-4 w-4 text-blue-600 flex-shrink-0" {{ in_array($style->id, old('travel_styles',
                            $plan->planStyles->pluck('style_id')->toArray())) ? 'checked' : '' }}>
                            <i class="{{ $style->fontawesome_icon }} text-xl flex-shrink-0"></i>
                            <h3 class="font-semibold text-sm truncate">{{ ucfirst($style->style_name) }}</h3>
                        </div>
                        <p class="text-xs text-gray-600 mt-2 truncate">
                            {{ $style->description ?? 'No description yet' }}
                        </p>
                    </label>
                    @endforeach
                </div>
            </div>

            <!-- Title -->
            <div class="mb-4">
                <x-input-label for="title" :value="'Title'" />
                <x-text-input id="title" name="title" type="text" value="{{ old('title', $plan->title) }}"
                    class="mt-1 block w-full" />
                @error('title')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Country -->
            <div class="mb-6">
                <label class="block mb-1 font-semibold text-sm">Country</label>
                <x-country-select name="country_id" :selected="old('country_id', $plan->country_id)" class="w-full" />
                @error('country_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div class="mb-6">
                <label class="block mb-1 font-semibold text-sm">Description</label>
                <textarea name="description" rows="4"
                    class="w-full border rounded-lg p-2 @error('description') border-red-500 @enderror">{{ old('description', $plan->description) }}</textarea>
                @error('description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Plan Date -->
            <div class="flex mb-6 space-x-4">
                <div class="flex-1">
                    <label class="block mb-1 font-semibold text-sm">From</label>
                    <input type="date" name="start_date" value="{{ old('start_date', $plan->start_date) }}"
                        class="w-full border rounded-lg p-2 @error('start_date') border-red-500 @enderror">
                    @error('start_date')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex-1">
                    <label class="block mb-1 font-semibold text-sm">To</label>
                    <input type="date" name="end_date" value="{{ old('end_date', $plan->end_date) }}"
                        class="w-full border rounded-lg p-2 @error('end_date') border-red-500 @enderror">
                    @error('end_date')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Max Participants -->
            <div class="mb-6">
                <label class="block mb-1 font-semibold text-sm">Max Participants</label>
                <input type="number" name="max_participants"
                    value="{{ old('max_participants', $plan->max_participants) }}"
                    class="w-full border rounded-lg p-2 @error('max_participants') border-red-500 @enderror">
                @error('max_participants')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="text-center">
                <x-primary-button class="ml-3">
                    {{ __('Edit') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>