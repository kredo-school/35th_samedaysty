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


<footer class="bg-sky-700 text-white py-10">
  <div class="max-w-6xl mx-auto px-4 flex flex-col sm:flex-row sm:items-start sm:justify-between">
    
      
    <!-- Logo  -->
    <div class="mb-8 sm:mb-0 flex-shrink-0 bg-white px-4 py-2 rounded-lg">
      <a href="/" class="flex items-center space-x-2">
        <img src="/images/logo.png" alt="Logo" class="h-10 w-auto">
        
      </a>
    </div>

    <!-- Links  -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-8 sm:ml-8 sm:text-left">
      
      <!-- Quick Links -->
      <div>
        <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
        <ul class="space-y-2">
          <li><a href="#" class="text-white hover:text-orange-400 text-sm">{{ __('HOME') }}</a></li>
          <li><a href="#" class="text-white hover:text-orange-400 text-sm">{{ __('ABOUT') }}</a></li>
          <li><a href="#" class="text-white hover:text-orange-400 text-sm">{{ __('Find other plans') }}</a></li>
          <li><a href="#" class="text-white hover:text-orange-400 text-sm">{{ __('Share your plans') }}</a></li>
        </ul>
      </div>

      <!-- Account -->
      <div>
        <h3 class="text-lg font-semibold mb-4">Account</h3>
        <ul class="space-y-2">
          <li><a href="#" class="text-white hover:text-orange-400 text-sm">{{ __('Dashboard') }}</a></li>
          <li><a href="#" class="text-white hover:text-orange-400 text-sm">{{ __('Login') }}</a></li>
          <li><a href="#" class="text-white hover:text-orange-400 text-sm">{{ __('Register') }}</a></li>
        </ul>
      </div>

      <!-- Contact -->
      <div>
        <h3 class="text-lg font-semibold mb-4">Contact</h3>
        <ul class="space-y-2">
          <li><a href="#" class="text-white hover:text-orange-400 text-sm">{{ __('Help and Support') }}</a></li>
          <li><span>📍 Address: Tokyo, Japan</span></li>
          <li><span>✉️ Email: info@example.com</span></li>
        </ul>
      </div>

    <!-- CopyRight -->
    <div class="mt-8 text-center text-gray-400 text-sm">
        © 2025 SameDaysty. All rights reserved.
    </div>
    </footer>
