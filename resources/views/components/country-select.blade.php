@props([
'name' => 'country',
'selected' => null,
'autoSubmit' => false,
'placeholder' => 'Select a country'
])

@php
$countries = \App\Models\Country::getGroupedByRegion();
$selectedCountry = $selected ? \App\Models\Country::find($selected) : null;
@endphp

<div class="flex items-center space-x-3">
    <!-- Selected Country Flag Display -->
    @if($selectedCountry)
    <div class="flex items-center">
        <i class="fi fi-{{ strtolower($selectedCountry->code) }} text-2xl mr-2"></i>
        <span class="font-medium">{{ $selectedCountry->name }}</span>
    </div>
    @endif

    <!-- Simple Select -->
    <select name="{{ $name }}" {{ $autoSubmit ? 'onchange=this.form.submit()' : '' }} {{ $attributes->merge(['class' =>
        'border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500']) }}>

        <option value="">🌍 {{ $placeholder }}</option>

        @foreach($countries as $region => $regionCountries)
        <optgroup label="🌏 {{ $region }}">
            @foreach($regionCountries as $country)
            <option value="{{ $country->id }}" {{ $selected==$country->id ? 'selected' : '' }}>
                {{ $country->name }}
            </option>
            @endforeach
        </optgroup>
        @endforeach
    </select>
</div>