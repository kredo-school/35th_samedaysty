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

<div class="w-full">
    <!-- Selected Country Flag Display -->
    @if($selectedCountry)
    <div class="flex items-center mb-2 p-2 border rounded-lg">
        <i class="fi fi-{{ strtolower($selectedCountry->code) }} text-xl mr-2"></i>
        <span class="font-medium">{{ $selectedCountry->name }}</span>
    </div>
    @endif

    <!-- Simple Select -->
    <select name="{{ $name }}" {{ $autoSubmit ? 'onchange=this.form.submit()' : '' }} {{ $attributes->merge(['class' =>
        'w-full border rounded-lg p-2']) }} @error($name) class="border-red-500" @enderror>

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