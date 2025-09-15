<x-app-layout>
    <x-title>
        {{ __('HELP and SUPPORT') }}
    </x-title>

    <div class="max-w-4xl mx-auto px-6 py-12">
        <h1 class="text-3xl font-bold text-sky-700 mb-6">Support</h1>
        <p class="mb-8 text-gray-700">
            Need help? Find answers to common questions or reach out to us directly.
        </p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="p-6 border rounded-lg shadow">
                <h2 class="text-xl font-semibold mb-2">FAQs</h2>
                <p class="text-gray-600">Check our most frequently asked questions.</p>
            </div>
            <div class="p-6 border rounded-lg shadow">
                <h2 class="text-xl font-semibold mb-2">Contact Us</h2>
                <p class="text-gray-600">Reach us via email or chat for direct support.</p>
            </div>
        </div>
    </div>
</x-app-layout>
