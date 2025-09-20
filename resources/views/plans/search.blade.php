<x-app-layout>
    <x-title>
        Search plans
    </x-title>
    <div class="px-20">
        <div class="flex items-center mt-3 justify-end mb-2">
            <div class="flex items-center mr-4">
                @if ($country)
                <i class="fi fi-{{ strtolower($country->code) }} text-3xl mr-2"></i>
                <span class="text-lg font-semibold">{{ $country->name }}</span>
                @else
                <span class="text-gray-500">All Countries</span>
                @endif
            </div>

            <form action="{{ route('plan.search') }}" method="get">
                <div class="flex items-center space-x-2">
                    <select name="country" onchange="this.form.submit()"
                        class="bg-white border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">🌍 All Countries</option>

                        @foreach($grouped_countries as $region => $countries)
                        <optgroup label="🌏 {{ $region }}">
                            @foreach($countries as $country)
                            <option value="{{ $country->id }}" {{ request('country')==$country->id ? 'selected' : '' }}>
                                {{ $country->name }}
                            </option>
                            @endforeach
                        </optgroup>
                        @endforeach
                    </select>

                    <x-primary-button>search</x-primary-button>
                </div>
            </form>
        </div>
        <div class="">
            <x-calendar :countryId="request('country')"></x-calendar>
        </div>
    </div>

</x-app-layout>