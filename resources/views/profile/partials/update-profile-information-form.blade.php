<section class="max-w-3xl mx-auto space-y-6">
    <div class="text-left">
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile.") }}
        </p>
    </div>

    <div class="flex flex-col md:flex-row md:space-x-6 items-center">
        <!--avatar next update-->
        <div class="flex-none w-36 h-36 rounded-full bg-white flex items-center justify-center border border-orange-500 overflow-hidden mb-3 md:mb-0">
            <i class="fa-solid fa-dragon text-gray-600 text-8xl"></i>
            {{-- <img scr="{{ $user->avatar }}" class="w-full h-full object-cover"> --}}
        </div>

        <!--approve by mail-->
        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
            @csrf
        </form>

        <!--name+email-->
        <form method="post" action="{{ route('profile.update') }}" class="flex-1 space-y-6">
            @csrf
            @method('patch')
            <!--name-->
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                <x-input-error class="mt-1" :messages="$errors->get('name')" />
            </div>
            <!--email-->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
                <x-input-error class="mt-1" :messages="$errors->get('email')" />

                <!--bio-->
                <div class="mt-6" x-data="{ charCount: 0, max: 500 }" x-init="charCount = $refs.intro.value.length">
                    <x-input-label for="bio" :value="__('Introduction')" />

                    <textarea
                        id="bio" name="bio" rows="4" maxlength="500" x-ref="intro" @input="charCount = $refs.intro.value.length"
                        class="text-lg mt-1 block w-full rounded-md border p-2
                        border-gray-300 focus:ring-indigo-500 focus:border-indigo-500
                        dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 shadow-sm sm:text-sm"
                        placeholder="Write a short introduction about yourself">{{ old('bio', $user->bio) }}</textarea>

                    <p class="text-sm mt-1" :class="charCount > max ? 'text-red-500' : 'text-gray-400'">
                        <span x-text="max - charCount"></span> characters remaining
                    </p>

                    <x-input-error class="mt-2" :messages="$errors->get('bio')" />
                </div>


                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                    <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </p>
                    @endif
                </div>
                @endif
            </div>

            <div class="flex items-center gap-4 ">
                <x-primary-button>{{ __('Save') }}</x-primary-button>

                @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
                @endif
            </div>
        </form>
    </div>
</section>