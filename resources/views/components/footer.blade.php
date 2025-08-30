<footer class="bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="flex justify-between items-center">
            <!-- Logo on the left -->
            <div class="flex items-center">
                <a href="{{ route('dashboard') }}" class="flex items-center">
                    <x-application-logo class="h-16 w-auto" />
                </a>
            </div>

            <!-- Links on the right -->
            <div class="flex flex-col space-y-2">
                <a href="#" class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 text-sm">
                    {{ __('Privacy Policy') }}
                </a>
                <a href="#" class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 text-sm">
                    {{ __('Terms of Service') }}
                </a>
                <a href="#" class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 text-sm">
                    {{ __('Contact') }}
                </a>
                <a href="#" class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 text-sm">
                    {{ __('About') }}
                </a>
            </div>
        </div>

        <!-- Copyright -->
        <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
            <div class="text-center text-gray-500 dark:text-gray-400 text-sm">
                © {{ date('Y') }} {{ config('app.name', 'Laravel') }}. {{ __('All rights reserved.') }}
            </div>
        </div>
    </div>
</footer>
