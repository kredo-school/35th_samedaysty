<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Travel Style') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <!-- Back Button -->
                    <div class="mb-6">
                        <a href="{{ route('admin.travel-styles.index') }}" class="text-blue-600 hover:text-blue-800">
                            ← Back to Travel Styles
                        </a>
                    </div>

                    <!-- Edit Form -->
                    <form action="{{ route('admin.travel-styles.update', $travelStyle) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-6">
                            <label for="style_name" class="block text-sm font-medium text-gray-700 mb-2">
                                Style Name
                            </label>
                            <input type="text" id="style_name" name="style_name"
                                value="{{ old('style_name', $travelStyle->style_name) }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="e.g., chill, activity, adventure" required>

                            @error('style_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror

                            <p class="mt-1 text-sm text-gray-500">
                                Enter a unique style name (will be converted to lowercase)
                            </p>
                        </div>

                        <div class="mb-6">
                            <label for="icon_class" class="block text-sm font-medium text-gray-700 mb-2">
                                Icon Class (FontAwesome)
                            </label>
                            <input type="text" id="icon_class" name="icon_class"
                                value="{{ old('icon_class', $travelStyle->icon_class) }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="e.g., fas fa-spa, fas fa-mountain">

                            @error('icon_class')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror

                            <p class="mt-1 text-sm text-gray-500">
                                Enter FontAwesome icon class (optional)
                            </p>
                        </div>

                        <div class="mb-6">
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                                Description
                            </label>
                            <textarea id="description" name="description" rows="4"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Enter a description for this travel style">{{ old('description', $travelStyle->description) }}</textarea>

                            @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror

                            <p class="mt-1 text-sm text-gray-500">
                                Provide a detailed description (optional)
                            </p>
                        </div>

                        <div class="flex items-center justify-end space-x-4">
                            <a href="{{ route('admin.travel-styles.index') }}"
                                class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                                Cancel
                            </a>
                            <button type="submit"
                                class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                Update Travel Style
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>