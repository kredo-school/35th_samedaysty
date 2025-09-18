<x-app-layout>
    <div class="">
        <x-title name="header">
            {{ __('Edit Profile') }}
        </x-title>
    </div>

    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="m-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg border border-sky-700"">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="m-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg border border-sky-700"">
                <div class="max-w-xl">
                    @include('profile.partials.update-recommended-form')
                </div>
            </div>

            <div class="m-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg mt-2 border border-sky-700"">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="m-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg mt-3 border border-sky-700"">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
