<section class="max-w-3xl mx-auto space-y-6">
    <div class="text-left">
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Recommended items') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your special items.") }}
        </p>
    </div>
    <form method="POST" action="{{ route('profile.updateGadget') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PATCH')

        {{-- item --}}
        @foreach (['item1' => $item1 ?? null, 'item2' => $item2 ?? null, 'item3' => $item3 ?? null] as $key => $gadget)
        <div class="flex flex-col md:flex-row md:space-x-4 items-start mb-6">
            {{-- image --}}
            <div x-data="{ previewUrl: '{{ isset($gadget) && $gadget->photo_url ? asset('storage/' . $gadget->photo_url) : '' }}' }" class="flex flex-col items-center">
                <input x-ref="{{ $key }}_photo" type="file" name="{{ $key }}_photo" id="{{ $key }}_photo" class="hidden" accept="image/*"
                    @change="
                        const file = $event.target.files[0];
                        if(file) {
                            const reader = new FileReader();
                            reader.onload = e => previewUrl = e.target.result;
                            reader.readAsDataURL(file);
                        }">
                <template x-if="previewUrl">
                    <img :src="previewUrl" class="w-32 h-32 rounded-lg object-cover border mb-2">
                </template>
                <template x-if="!previewUrl">
                    <div class="w-32 h-32 flex items-center justify-center rounded-lg border bg-gray-200 text-gray-500 mb-2">
                        <i class="fa-solid fa-image text-3xl"></i>
                    </div>
                </template>
                <x-primary-button type="button" @click="$refs.{{ $key }}_photo.click()">
                    Select Image
                </x-primary-button>
            </div>

            {{-- gadgets name + description --}}
            <div class="flex-1">
                <x-input-label for="{{ $key }}" :value="__(ucfirst($key) . ' Name')" />
                <x-text-input id="{{ $key }}" name="{{ $key }}" type="text" class="mt-1 block w-full"
                    :value="old($key, $gadget->item_name ?? '')" />

                <x-input-label for="{{ $key }}_description" :value="__(ucfirst($key) . ' Description')" class="mt-2" />
                <div x-data="{ charCount: 0, max: 300 }" x-init="charCount = $refs.desc.value.length">
                    <textarea id="{{ $key }}_description" name="{{ $key }}_description" rows="2" maxlength="300" x-ref="desc"
                        @input="charCount = $refs.desc.value.length"
                        class="mt-1 block w-full rounded border-gray-300 shadow-sm"
                        placeholder="Write a short description">{{ old($key . '_description', $gadget->memo ?? '') }}</textarea>
                    <p class="text-sm mt-1" :class="charCount > max ? 'text-red-500' : 'text-gray-400'">
                        <span x-text="max - charCount"></span> characters remaining
                    </p>
                </div>
                <x-input-error class="mt-1" :messages="$errors->get($key . '_description')" />
            </div>
        </div>
        @endforeach

        <div class="flex items-center gap-4">
            <x-secondary-button type="submit">{{ __('Save All Items') }}</x-secondary-button>
        </div>
    </form>
</section>