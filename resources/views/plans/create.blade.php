<x-app-layout>
    <div class="w-full px-30">
        <x-slot name="header">
            <h1 class="text-2xl md:text-3xl lg:text-4xl text-center">
                <span class="font-bold text-orange-500">CREATE</span>
                <span class="font-bold text-sky-700">&nbsp;PLAN</span>
            </h1>
        </x-slot>

        <form action="{{ route('plan.store') }}" method="POST" class="p-6 px-12 max-w-4xl mx-auto bg-white rounded-lg shadow">
            @csrf

            <!-- Avatar + Name -->
            <div class="flex items-center justify-start space-x-2 mb-10">
                <img src="/images/bellman.png" alt="Avatar" class="w-10 h-10 rounded-full">
                <h1 class="text-2xl md:text-3xl lg:text-4xl text-center">
                    <span class="ml-2 font-bold text-gray-800">カビルンルン</span>
                </h1>
            </div>

            <!-- Travel Style -->
            <div class="mb-6">
                <h2 class="font-semibold mb-2">Travel Style</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                    
                    {{-- 1 --}}
                    <label class="flex items-center space-x-3 border rounded-lg p-2 cursor-pointer hover:bg-gray-50">
                        <input type="checkbox" name="travel_styles[]" value="relax" class="h-5 w-5 text-blue-600">
                        <i class="fa-solid fa-spa text-xl text-[#F5BABB]"></i>
                        <div>
                            <h3 class="font-semibold text-sm">Relaxation</h3>
                            <p class="text-xs text-gray-600">Hot springs, spas, beach resorts</p>
                        </div>
                    </label>

                    {{-- 2 --}}
                    <label class="flex items-center space-x-3 border rounded-lg p-2 cursor-pointer hover:bg-gray-50">
                        <input type="checkbox" name="travel_styles[]" value="adventure" class="h-5 w-5 text-blue-600">
                        <i class="fa-solid fa-person-hiking text-xl text-[#FFC900]"></i>
                        <div>
                            <h3 class="font-semibold text-sm">Adventure</h3>
                            <p class="text-xs text-gray-600">Hiking, diving, surfing</p>
                        </div>
                    </label>

                    {{-- 3 --}}
                    <label class="flex items-center space-x-3 border rounded-lg p-2 cursor-pointer hover:bg-gray-50">
                        <input type="checkbox" name="travel_styles[]" value="nature" class="h-5 w-5 text-blue-600">
                        <i class="fa-solid fa-mountain text-xl text-[#239BA7]"></i>
                        <div>
                            <h3 class="font-semibold text-sm">Nature</h3>
                            <p class="text-xs text-gray-600">World Heritage, parks, scenic drives</p>
                        </div>
                    </label>

                    {{-- 4 --}}
                    <label class="flex items-center space-x-3 border rounded-lg p-2 cursor-pointer hover:bg-gray-50">
                        <input type="checkbox" name="travel_styles[]" value="cultural" class="h-5 w-5 text-blue-600">
                        <i class="fa-solid fa-landmark text-xl text-[#BB6653]"></i>
                        <div>
                            <h3 class="font-semibold text-sm">Cultural</h3>
                            <p class="text-xs text-gray-600">Temples, castles, museums</p>
                        </div>
                    </label>
                </div>
            </div>

            <!-- Title と Country -->
            <div class="flex mb-6 space-x-4">
                <div class="flex-1">
                    <label class="block mb-1 font-semibold text-sm">Title</label>
                    <input type="text" name="title" class="w-full border rounded-lg p-2">
                </div>
                <div class="flex-1">
                    <label class="block mb-1 font-semibold text-sm">Country</label>
                    <select name="country" class="w-full border rounded-lg p-2">
                        <option>Japan</option>
                        <option>Australia</option>
                        <option>Thailand</option>
                    </select>
                </div>
            </div>

            <!-- Description -->
            <div class="mb-6">
                <label class="block mb-1 font-semibold text-sm">Description</label>
                <textarea name="description" rows="4" class="w-full border rounded-lg p-2"></textarea>
            </div>

            <!-- Plan Date -->
            <div class="flex mb-6 space-x-4">
                <div class="flex-1">
                    <label class="block mb-1 font-semibold text-sm">From</label>
                    <input type="date" name="start_date" class="w-full border rounded-lg p-2">
                </div>
                <div class="flex-1">
                    <label class="block mb-1 font-semibold text-sm">To</label>
                    <input type="date" name="end_date" class="w-full border rounded-lg p-2">
                </div>
            </div>

            <!-- Max Participants -->
            <div class="mb-6">
                <label class="block mb-1 font-semibold text-sm">Max Participants</label>
                <input type="number" name="max_participants" class="w-full border rounded-lg p-2">
            </div>

            <!-- Submit Button -->
            <div class="text-center">
                <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 px-6 rounded-full">
                    Create Plan
                </button>
            </div>

            @if(session('success'))
            <div class="mt-4 max-w-2xl mx-auto p-4 bg-green-50 border border-green-300 text-green-800 rounded-lg shadow">
                <p class="font-semibold">✅ Success</p>
                <p>{{ session('success') }}</p>
            </div>
            @endif
        </form>
    </div>
</x-app-layout>
