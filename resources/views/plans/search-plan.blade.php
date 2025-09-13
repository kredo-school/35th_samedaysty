<x-app-layout>
    <x-title>
        Search plans
    </x-title>
    <div class="px-20">
        <div class="flex items-center mt-3 justify-end mb-2">
            @if ($country)
                <i class="fi fi-{{ $country->code }} text-3xl me-2"></i>
            @endif
            <form action="{{ route('plan.search') }}" method="get">
                <select name="country" id="country">
                    <option value="">select a country</option>
                    @foreach($all_countries as $country)
                        <option value="{{ $country->id }}" {{ request('country') == $country->id ? 'selected' : '' }}>{{ $country->name }}</option>
                    @endforeach
                </select>
                <x-primary-button>search</x-primary-button>
            </form>
        </div>
        <div class="">
            <x-calendar></x-calendar>
        </div>
    </div>

</x-app-layout>