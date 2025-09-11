<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Travel Style Details') }}
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

                    <!-- Style Details -->
                    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                        <div class="px-4 py-5 sm:px-6">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">
                                Travel Style Information
                            </h3>
                            <p class="mt-1 max-w-2xl text-sm text-gray-500">
                                Details about the travel style
                            </p>
                        </div>
                        <div class="border-t border-gray-200">
                            <dl>
                                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">
                                        ID
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                        {{ $travelStyle->id }}
                                    </dd>
                                </div>
                                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">
                                        Style Name
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                        {{ $travelStyle->style_name }}
                                    </dd>
                                </div>
                                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">
                                        Display Name
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                        {{ $travelStyle->display_name }}
                                    </dd>
                                </div>
                                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">
                                        Created At
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                        {{ $travelStyle->created_at->format('Y-m-d H:i:s') }}
                                    </dd>
                                </div>
                                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">
                                        Updated At
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                        {{ $travelStyle->updated_at->format('Y-m-d H:i:s') }}
                                    </dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="mt-6 flex items-center justify-end space-x-4">
                        <a href="{{ route('admin.travel-styles.edit', $travelStyle) }}"
                            class="px-4 py-2 bg-indigo-500 text-white rounded-md hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            Edit
                        </a>
                        <form action="{{ route('admin.travel-styles.destroy', $travelStyle) }}" method="POST"
                            class="inline"
                            onsubmit="return confirm('Are you sure you want to delete this travel style?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500">
                                Delete
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
