<section class="max-w-3xl mx-auto space-y-6">
    <div class="text-left">
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('3 essentials for my travel ') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your special items.") }}
        </p>
    </div>

    <!--update-->
    <form method="POST" action="{{ route('profile.updateGadget') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PATCH')

        {{-- Gadgets --}}
        @foreach (['item1' => $item1 ?? null, 'item2' => $item2 ?? null, 'item3' => $item3 ?? null] as $key => $gadget)
        <div class="flex flex-col lg:flex-row lg:items-start lg:gap-6 border-b pb-4 mb-4">

            <!--gadgets photo-->
            <div x-data="{ previewUrl: @js($gadget->photo_url ?? ''),error:'' }" class="flex flex-col items-start lg:w-1/3">
                <input x-ref="{{ $key }}_photo" type="file" name="{{ $key }}_photo" class="hidden" accept="image/*"
                    @change="
                        const file = $event.target.files[0];
                        if(file) {
                            const validTypes = ['image/jpeg','image/png','image/gif'];
                            if (!validTypes.includes(file.type)) {
                                error = 'Please select one of the following formats: jpg, png, gif';
                                previewUrl = @js($gadget->photo_url ?? '');
                                $event.target.value = '';
                            } else if (file.size > 2 * 1024 * 1024) {
                                error = 'The selected image is too large. Maximum size is 2MB.';
                                previewUrl = @js($gadget->photo_url ?? '');
                                $event.target.value = '';
                            } else {
                                error = '';
                                const reader = new FileReader();
                                reader.onload = e => previewUrl = e.target.result;
                                reader.readAsDataURL(file);
                            }
                        } else {
                            previewUrl = @js($gadget->photo_url ?? '');
                            error = '';
                        }">
                <template x-if="previewUrl">
                    <img :src="previewUrl" class="w-32 h-32 rounded-lg object-cover border mb-2">
                </template>
                <template x-if="!previewUrl">
                    <div class="w-32 h-32 flex items-center justify-center rounded-lg border bg-gray-200 text-gray-500 mb-2">
                        <i class="fa-solid fa-image text-3xl"></i>
                    </div>
                </template>
            <!--error message-->
                <p class="text-red-500 text-sm mt-1" x-text="error" x-show="error"></p>
                <x-input-error class="mt-1 text-red-500" :messages="$errors->get($key . '_photo')" />
            <!--save button-->
                <x-primary-button type="button" @click="$refs.{{ $key }}_photo.click()">Select Image</x-primary-button>
            </div>

            <div class="flex-1 lg:w-2/3">
                <x-input-label for="{{ $key }}" :value="__(ucfirst($key) . ' Name')" />
                <x-text-input id="{{ $key }}" name="{{ $key }}" type="text" class="mt-1 block w-full"
                    :value="old($key, $gadget->item_name ?? '')" />

                <x-input-label for="{{ $key }}_description" :value="__(ucfirst($key) . ' Description')" class="mt-2" />
                <textarea id="{{ $key }}_description" name="{{ $key }}_description" rows="4" maxlength="500"
                    class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 resize-none"
                    placeholder="Write a short description">{{ old($key . '_description', $gadget->memo ?? '') }}</textarea>

                <x-input-label for="{{ $key }}_url" :value="__(ucfirst($key) . ' URL')" class="mt-2" />
                <x-text-input id="{{ $key }}_url" name="{{ $key }}_url" type="url" class="mt-1 block w-full"
                    placeholder="https://example.com"
                    :value="old($key . '_url', $gadget->shop_url ?? '')" />
            </div>
        </div>
        @endforeach

        <!--button-->
        <div class="flex items-center justify-center gap-4">
            <x-secondary-button type="submit">{{ __('Save All Gadgets') }}</x-secondary-button>
        </div>
    </form>

    <!-- delete gadgets-->
    <div class="mt-6 space-y-3">
        @foreach ([$item1, $item2, $item3] as $gadget)
        @if(!empty($gadget) && $gadget->id)
        <form action="{{ route('profile.gadget.destroy', $gadget->id) }}" method="POST"
            onsubmit="return confirm('Are you sure you want to delete this gadget?');">
            @csrf
            @method('DELETE')
            <button type="submit"
                class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 text-sm w-full text-center">
                Delete Gadget: {{ $gadget->item_name }}
            </button>
        </form>
        @endif
        @endforeach
    </div>
</section>