@props(['src' => 'images/logo.png', 'alt' => null])

<img src="{{ asset($src) }}" 
     alt="{{ $alt ?? config('app.name', 'Laravel') }}" 
     {{ $attributes->merge(['class' => 'object-contain']) }}>
