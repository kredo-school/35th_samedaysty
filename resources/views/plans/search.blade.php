<x-app-layout>
    <x-title>
        Search plans
    </x-title>
    <div class="px-20">
        <div class="flex items-center mt-3 justify-end mb-2">
            <form action="{{ route('plan.search') }}" method="get">
                <x-country-select :selected="request('country')" :auto-submit="true" />
            </form>
        </div>
        <div class="">
            <x-calendar :countryId="request('country')"></x-calendar>
        </div>
    </div>

</x-app-layout>