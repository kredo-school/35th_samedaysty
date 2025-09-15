<section class="max-w-3xl mx-auto space-y-6">
    <div class="text-left">
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Recommended items') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your special items.") }}
        </p>
    </div>
    <form method="POST" action="{{ route('profile.updateItems') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PATCH')

        <!-- Item1 -->
        <div class="flex flex-col md:flex-row md:space-x-4 items-start mb-6">
            <!-- Item1 image -->
            <div x-data="{ previewUrl: '{{ $user->item1_image ? asset('storage/' . $user->item1_image) : '' }}' }" class="flex flex-col items-center">
                <input x-ref="item1_image" type="file" name="item1_image" id="item1_image" class="hidden" accept="image/*"
                    @change="
                    const file = $event.target.files[0];
                    if(file) {
                        const reader = new FileReader();
                        reader.onload = e => previewUrl = e.target.result;
                        reader.readAsDataURL(file);
                    }
                ">
                <template x-if="previewUrl">
                    <img :src="previewUrl" class="w-32 h-32 rounded-full object-cover border mb-2">
                </template>
                <template x-if="!previewUrl">
                    <div class="w-32 h-32 flex items-center justify-center rounded-full border bg-gray-200 text-gray-500 mb-2">
                        <i class="fa-solid fa-image text-3xl"></i>
                    </div>
                </template>
                <!-- Item1 Image Button -->
                <x-primary-button type="button" @click="$refs.item1_image.click()">
                    Select Image
                </x-primary-button>
            </div>

            <!-- Item1 name + description -->
            <div class="flex-1">
                <x-input-label for="item1" :value="__('Item1 Name')" />
                <x-text-input id="item1" name="item1" type="text" class="mt-1 block w-full" :value="old('item1', $user->item1)"/>

                <x-input-label for="item1_description" :value="__('Item1 Description')" class="mt-2" />
                <div x-data="{ charCount: 0, max: 300 }" x-init="charCount = $refs.desc.value.length">
                    <textarea id="item1_description" name="item1_description" rows="2" maxlength="300" x-ref="desc"
                        @input="charCount = $refs.desc.value.length"
                        class="mt-1 block w-full rounded border-gray-300 shadow-sm"
                        placeholder="Write a short description">{{ old('item1_description', $user->item1_description) }}</textarea>
                    <p class="text-sm mt-1" :class="charCount > max ? 'text-red-500' : 'text-gray-400'">
                        <span x-text="max - charCount"></span> characters remaining
                    </p>
                </div>
                <x-input-error class="mt-1" :messages="$errors->get('item1_description')" />
            </div>
        </div>

        <!-- Item2 -->
        <div class="flex flex-col md:flex-row md:space-x-4 items-start mb-6">
            <div x-data="{ previewUrl: '{{ $user->item2_image ? asset('storage/' . $user->item2_image) : '' }}' }" class="flex flex-col items-center">
                <input x-ref=item1_image" type="file" name="item2_image" id="item2_image" class="hidden" accept="image/*"
                    @change="
                    const file = $event.target.files[0];
                    if(file) {
                        const reader = new FileReader();
                        reader.onload = e => previewUrl = e.target.result;
                        reader.readAsDataURL(file);
                    }
                ">
                <template x-if="previewUrl">
                    <img :src="previewUrl" class="w-32 h-32 rounded-full object-cover border mb-2">
                </template>
                <template x-if="!previewUrl">
                    <div class="w-32 h-32 flex items-center justify-center rounded-full border bg-gray-200 text-gray-500 mb-2">
                        <i class="fa-solid fa-image text-3xl"></i>
                    </div>
                </template>
                <!-- Item1 Image Button -->
                <x-primary-button type="button" @click="$refs.item2_image.click()">
                    Select Image
                </x-primary-button>
            </div>
            <!--Item2 name + description-->
            <div class="flex-1">
                <x-input-label for="item2" :value="__('Item2 Name')" />
                <x-text-input id="item2" name="item2" type="text" class="mt-1 block w-full" :value="old('item2', $user->item2)"/>

                <x-input-label for="item2_description" :value="__('Item2 Description')" class="mt-2" />
                <div x-data="{ charCount: 0, max: 500 }" x-init="charCount = $refs.desc2.value.length">
                    <textarea id="item2_description" name="item2_description" rows="2" maxlength="300" x-ref="desc2"
                        @input="charCount = $refs.desc2.value.length"
                        class="mt-1 block w-full rounded border-gray-300 shadow-sm"
                        placeholder="Write a short description">{{ old('item2_description', $user->item2_description) }}</textarea>
                    <p class="text-sm mt-1" :class="charCount > max ? 'text-red-500' : 'text-gray-400'">
                        <span x-text="max - charCount"></span> characters remaining
                    </p>
                </div>
                <x-input-error class="mt-1" :messages="$errors->get('item2_description')" />
            </div>
        </div>

        <!-- Item3 -->
        <div class="flex flex-col md:flex-row md:space-x-4 items-start mb-6">
            <div x-data="{ previewUrl: '{{ $user->item3_image ? asset('storage/' . $user->item3_image) : '' }}' }" class="flex flex-col items-center">
                <input x-ref="item3_image" type="file" name="item3_image" id="item3_image" class="hidden" accept="image/*"
                    @change="
                    const file = $event.target.files[0];
                    if(file) {
                        const reader = new FileReader();
                        reader.onload = e => previewUrl = e.target.result;
                        reader.readAsDataURL(file);
                    }
                ">
                <template x-if="previewUrl">
                    <img :src="previewUrl" class="w-32 h-32 rounded-full object-cover border mb-2">
                </template>
                <template x-if="!previewUrl">
                    <div class="w-32 h-32 flex items-center justify-center rounded-full border bg-gray-200 text-gray-500 mb-2">
                        <i class="fa-solid fa-image text-3xl"></i>
                    </div>
                </template>
                <!-- Item3 Image Button -->
                <x-primary-button type="button" @click="$refs.item3_image.click()">
                    Select Image
                </x-primary-button>
            </div>
            <!--name + descrioption-->
            <div class="flex-1">
                <x-input-label for="item3" :value="__('Item3 Name')" />
                <x-text-input id="item3" name="item3" type="text" class="mt-1 block w-full" :value="old('item3', $user->item3)"/>

                <x-input-label for="item3_description" :value="__('Item3 Description')" class="mt-2" />
                <div x-data="{ charCount: 0, max: 500 }" x-init="charCount = $refs.desc3.value.length">
                    <textarea id="item3_description" name="item3_description" rows="2" maxlength="300" x-ref="desc3"
                        @input="charCount = $refs.desc3.value.length"
                        class="mt-1 block w-full rounded border-gray-300 shadow-sm"
                        placeholder="Write a short description">{{ old('item3_description', $user->item3_description) }}</textarea>
                    <p class="text-sm mt-1" :class="charCount > max ? 'text-red-500' : 'text-gray-400'">
                        <span x-text="max - charCount"></span> characters remaining
                    </p>
                </div>
                <x-input-error class="mt-1" :messages="$errors->get('item3_description')" />
            </div>
        </div>

        <div class="flex items-center gap-4">
            <x-secondary-button type="submit">{{ __('Save All Items') }}</x-secondary-button>
        </div>
    </form>
</section>