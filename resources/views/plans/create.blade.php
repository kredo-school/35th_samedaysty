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
            <div>
                {{--
                <!-- 1: Auth user icon name -->
                <div class="flex items-center mb-10">
                    <!-- UserIcon -->
                    <img src="{{ Auth::user()->profile_photo_url ?? '/path/to/default-icon.png' }}" alt="User Icon" class="w-12 h-12 rounded-full mr-4">

                <!--　UserNAME -->
                <span class="text-lg font-semibold">
                    {{ Auth::user()->name }}
                </span>
            </div> --}}


            <div class="flex items-center justify-start space-x-2 mb-10">
                <img src="/images/bellman.png" alt="Avatar" class="w-10 h-10 rounded-full">
                <h1 class="text-2xl md:text-3xl lg:text-4xl text-center">
                    <span class="ml-2 font-bold text-gray-800">カビルンルン</span>
                </h1>
            </div>


            <!-- 2段目: Travel Style (チェックボックス15個) -->
            <div class="mb-6">
                <h2 class="font-semibold mb-2">Travel Style</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-2 border p-4 rounded-lg">
                    <!-- チェックボックス15個 -->
                    <label class="flex items-center space-x-2 text-sm">
                        <input type="checkbox" class="form-checkbox h-4 w-4">
                        <i class="fa-solid fa-spa text-xl text-[#F5BABB]"></i>
                        <div>
                            <h3 class="font-semibold text-sm">Relaxation</h3>
                        </div>
                    </label>

                    <label class="flex items-center space-x-2 text-sm">
                        <input type="checkbox" class="form-checkbox h-4 w-4">
                        <i class="fa-solid fa-person-hiking text-xl text-[#FFC900]"></i>
                        <h3 class="font-semibold">Adventure</h3>
                    </label>

                    <label class="flex items-center space-x-2 text-sm">
                        <input type="checkbox" class="form-checkbox h-4 w-4">
                        <i class="fa-solid fa-mountain text-xl text-[#239BA7]"></i>
                        <h3 class="font-semibold">Nature</h3>
                    </label>

                    <!- <!-- 以下、Style 3～15まで繰り返す -->
                </div>
            </div>




            <div class="mt-4">
                <label for="travel_styles" class="block font-bold mb-2">Travel style:</label>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 border-2 border-gray-300 rounded p-6 mb-6">


                    {{--
                        <form method="POST" action="{{ route('plans.store') }}">
                    @csrf --}}

                    {{-- <h3>旅行スタイルを選択してください</h3> --}}
                    {{-- @foreach($travelStyles as $style)
                            <div>
                                <label>
                                    <input type="checkbox" name="travel_styles[]" value="{{ $style->id }}">
                    {{ $style->name }}
                    </label>
                </div>
                @endforeach --}}

                {{-- <button type="submit">保存</button> --}}
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
            <i class="fa-solid fa-person-hiking text-xl text-[#FFC900]"></i>
            <div>
                <h3 class="font-semibold text-sm">Adventure</h3>
                <p class="text-xs text-gray-600">Hiking, diving, surfing</p>
            </div>
        </label>

        {{-- 3 --}}
        <label class="flex items-center space-x-3 border rounded-lg p-2 cursor-pointer hover:bg-gray-50">
            <input type="checkbox" name="travel_styles[]" value="relax" class="h-5 w-5 text-blue-600">
            <i class="fa-solid fa-mountain text-xl text-[#239BA7]"></i>
            <div>
                <h3 class="font-semibold text-sm">Nature</h3>
                <p class="text-xs text-gray-600">World Heritage, parks, scenic drives</p>
            </div>
        </label>

        {{-- 4 --}}
        <label class="flex items-center space-x-3 border rounded-lg p-2 cursor-pointer hover:bg-gray-50">
            <input type="checkbox" name="travel_styles[]" value="relax" class="h-5 w-5 text-blue-600">
            <i class="fa-solid fa-landmark text-xl text-[#BB6653]"></i>
            <div>
                <h3 class="font-semibold text-sm">Cultural</h3>
                <p class="text-xs text-gray-600">Temples, castles, museums</p>
            </div>
        </label>

    </div>
    </div>



{{-- 
    <div class="mb-6">
        <h2 class="font-semibold mb-2">Travel Style</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 border p-4 rounded-lg">
            @foreach ($all_categories as $category)
            <label class="flex items-center space-x-2 text-sm cursor-pointer">
                <input type="checkbox" name="category[]" value="{{ $category->id }}" class="form-checkbox h-4 w-4 @error('category') border-red-500 @enderror" id="category-{{ $category->id }}" {{ (is_array(old('category')) && in_array($category->id, old('category'))) ? 'checked' : '' }}>

                {{-- アイコン（FontAwesome） --}}
                {{-- <i class="fa-solid {{ $category->icon_class }} text-xl" style="color: {{ $category->icon_color }}"></i>

                <h3 class="font-semibold">{{ $category->name }}</h3>
            </label>
            @endforeach
        </div>

        {{-- バリデーションエラー --}}
        {{-- @error('category')
        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div> --}} 


    <!-- 3段目: Title と Country -->
    <div class="flex mb-6 space-x-4">
        <div class="flex-1">
            <label class="block mb-1 font-semibold text-sm">Title</label>
            <input type="text" placeholder="旅行プランのタイトル" class="w-full border rounded-lg p-2">
        </div>
        <div class="flex-1">
            <label class="block mb-1 font-semibold text-sm">Country</label>
            <select class="w-full border rounded-lg p-2">
                <option>Japan</option>
                <option>Australia</option>
                <option>Thailand</option>
                <!-- 他の国 -->
            </select>
        </div>
    </div>

    <!-- 4段目: Description -->
    <div class="mb-6">
        <label class="block mb-1 font-semibold text-sm">Description</label>
        <textarea rows="4" class="w-full border rounded-lg p-2" placeholder="内容を入力"></textarea>
    </div>

    <!-- 5段目: Plan Date -->
    <div class="flex mb-6 space-x-4">
        <div class="flex-1">
            <label class="block mb-1 font-semibold text-sm">From</label>
            <div class="relative">
                <input type="date" class="w-full border rounded-lg p-2 pr-10">
            </div>
        </div>
        <div class="flex-1">
            <label class="block mb-1 font-semibold text-sm">To</label>
            <div class="relative">
                <input type="date" class="w-full border rounded-lg p-2 pr-10">
            </div>
        </div>
    </div>

    <!-- 6段目: Max Participants -->
    <div class="mb-6">
        <label class="block mb-1 font-semibold text-sm">Max Participants</label>
        <input type="number" class="w-full border rounded-lg p-2" placeholder="人数を入力">
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

    <!-- ボタン -->
    <div class="text-center">
        <button class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 px-6 rounded-full">
            Create Plan
        </button>
    </div>
    </div>
    </div>





    </form>
</x-app-layout>
