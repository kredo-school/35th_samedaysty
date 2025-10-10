<footer class="bg-sky-700 dark:bg-gray-900 text-white py-10">
    <div class="max-w-6xl mx-auto px-4 flex flex-col sm:flex-row sm:items-start sm:justify-between">

        <!-- Logo  -->
        <div class="mb-8 sm:mb-0 flex-shrink-0 bg-white px-4 py-2 rounded-lg">
            <a href="/" class="flex items-center space-x-2">
                <img src="/images/logo.png" alt="Logo" class="h-10 w-auto">

            </a>
        </div>

        <!-- Links  -->
        <div class="grid grid-cols-2 sm:grid-cols-3 gap-8 px-4">

            <!-- Quick Links -->
            <div>
                <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
                <ul class="space-y-2">
                    <li><a href="/" class="text-white hover:text-orange-400 text-sm">{{
                            __('TOP') }}</a>
                    </li>
                    <li><a href="{{ route('dashboard') }}" class="text-white hover:text-orange-400 text-sm">{{
                            __('HOME') }}</a>
                    </li>
                    <li><a href="#about" class="text-white hover:text-orange-400 text-sm">{{ __('ABOUT') }}</a>
                    </li>
                    <li><a href="{{ route('plan.search') }}" class="text-white hover:text-orange-400 text-sm">{{
                            __('Find other plans') }}</a></li>
                    <li><a href="{{ route('plan.create') }}" class="text-white hover:text-orange-400 text-sm">{{
                            __('Share your plans') }}</a></li>
                </ul>
            </div>

            <!-- Account -->
            <div>
                <h3 class="text-lg font-semibold mb-4">Account</h3>
                <ul class="space-y-2">
                    <!-- <li>
                        <a href="{{ route('dashboard') }}" class="text-white hover:text-orange-400 text-sm">
                            {{ __('Dashboard') }}
                        </a>
                    </li> -->
                    <li>
                        <a href="{{ route('login') }}" class="text-white hover:text-orange-400 text-sm">
                            {{ __('Login') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('register') }}" class="text-white hover:text-orange-400 text-sm">
                            {{ __('Register') }}
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Contact -->
            <div>
                <h3 class="text-md font-semibold mb-4">Contact</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('support') }}" class="text-white hover:text-orange-400 text-sm">{{ __('Help
                            and Support') }}</a>
                    </li>
                    <li><span>📍 Address: Tokyo, Japan</span></li>
                    <li><span>✉️ Email: info@example.com</span></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- CopyRight -->
    <div class="mt-8 text-center text-gray-400 text-sm">
        © 2025 SameDaysty. All rights reserved.
    </div>
</footer>