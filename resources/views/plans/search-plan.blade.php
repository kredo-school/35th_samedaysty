<x-app-layout>
    <x-title>
        Search plans
    </x-title>
    <div class="flex items-center mt-3 px-20 justify-end">
        <form action="" method="post" class="">
            <i class="fi fi-jp text-3xl me-2"></i>
            <select name="" id="">
                @foreach($all_countries as $country)
                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                @endforeach
            </select>
        </form>
    </div>
</x-app-layout>