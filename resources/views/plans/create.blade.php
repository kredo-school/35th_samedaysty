<x-app-layout>
    <div class="w-full px-30">
        <x-slot name="header">
            <h1 class="text-2xl md:text-3xl lg:text-4xl text-center">
                <span class="font-bold text-orange-500">CREATE</span>
                <span class="font-bold text-sky-700">&nbsp;AN ACCOUNT</span>
            </h1>
        </x-slot>

        <form action="{{ route('plan.store') }}" method="POST" class="p-6 px-12 max-w-2xl mx-auto bg-white rounded-lg shadow">
            @csrf
            <div>

                <div class="flex items-center justify-start space-x-2">
                    <img src="/images/bellman.png" alt="Avatar" class="w-10 h-10 rounded-full">
                    <h1 class="text-2xl md:text-3xl lg:text-4xl text-center">
                        <span class="ml-2 font-bold text-gray-800">Risa</span>
                    </h1>
                </div>

                <div class="mt-4">
                    <label for="travel_styles" class="block font-bold mb-2">Travel style:</label>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 border-2 border-gray-300 rounded p-6">



                        <form method="POST" action="{{ route('plans.store') }}">
                            @csrf

                            <h3>旅行スタイルを選択してください</h3>
                            @foreach($travelStyles as $style)
                            <div>
                                <label>
                                    <input type="checkbox" name="travel_styles[]" value="{{ $style->id }}">
                                    {{ $style->name }}
                                </label>
                            </div>
                            @endforeach

                            <button type="submit">保存</button>
                        </form>



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
                            <input type="checkbox" name="travel_styles[]" value="relax" class="h-5 w-5 text-blue-600">
                            <i class="fa-solid fa-spa text-xl text-[#F5BABB]"></i>
                            <div>
                                <h3 class="font-semibold text-sm">Adventure</h3>
                                <p class="text-xs text-gray-600">Hiking, diving, surfing</p>
                            </div>
                        </label>

                        {{-- 3 --}}
                        <label class="flex items-center space-x-3 border rounded-lg p-2 cursor-pointer hover:bg-gray-50">
                            <input type="checkbox" name="travel_styles[]" value="relax" class="h-5 w-5 text-blue-600">
                            <i class="fa-solid fa-spa text-xl text-[#F5BABB]"></i>
                            <div>
                                <h3 class="font-semibold text-sm">Relaxation</h3>
                                <p class="text-xs text-gray-600">Hot springs, spas, beach resorts</p>
                            </div>
                        </label>

                        {{-- 4 --}}
                        <label class="flex items-center space-x-3 border rounded-lg p-2 cursor-pointer hover:bg-gray-50">
                            <input type="checkbox" name="travel_styles[]" value="relax" class="h-5 w-5 text-blue-600">
                            <i class="fa-solid fa-spa text-xl text-[#F5BABB]"></i>
                            <div>
                                <h3 class="font-semibold text-sm">Relaxation</h3>
                                <p class="text-xs text-gray-600">Hot springs, spas, beach resorts</p>
                            </div>
                        </label>

                    </div>
                </div>













                <div class="mt-4">
                    <label for="title">Title:</label>
                    <input id="title" type="text" name="title" required class="border rounded w-full p-2">
                </div>

                <div class="mt-4">
                    <label for="description">Description:</label>
                    <textarea id="description" name="description" class="border rounded w-full p-2"></textarea>
                </div>

                <div class="mt-4">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
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
</x-app-layout>
