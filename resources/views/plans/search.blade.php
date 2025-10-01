<x-app-layout>
    <x-title>
        Search plans
    </x-title>
    <div class="px-4 sm:px-8 lg:px-20 py-6">
        <div class="flex items-center justify-end mb-6">
            <form action="{{ route('plan.search') }}" method="get">
                <x-country-select :selected="request('country')" :auto-submit="true" />
            </form>
        </div>
        <div class="mb-6">
            <x-calendar :countryId="request('country')"></x-calendar>
        </div>
    </div>

</x-app-layout>