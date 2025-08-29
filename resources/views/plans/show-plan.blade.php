<x-app-layout>
    <!-- heading -->
    <h2 class="text-3xl md:text-4xl underline decoration-orange-500 decoration-2 me-auto">Plan details</h1>

    <div class="px-10">
        
        <!-- edit/delete buttons -->
        <div class="flex justify-end space-x-2 py-2">
            <a href="" class="border border-orange-500 text-orange-500 hover:bg-orange-500 hover:text-white font-bold px-4 rounded box-border">edit</a>
            <button class="bg-red-600 hover:bg-red-800 text-white font-bold px-4 rounded">delete</button>
        </div>
        
        <!-- plan details -->
        <div class="pt-3 flex items-center">
            <i class="fa-solid fa-circle-user text-gray-500 text-5xl"></i>
            <h4 class="text-xl ps-2">Username</h4>
            <h4 class="text-xl ms-auto px-2">Denmark</h4>
            <img src="/images/Flag_of_Denmark.png" alt="" class="h-8">
        </div>

        <div class="px-8 pt-4">
            <!-- style -->
            <div class="flex pt-2 items-center">
                <h4 class="text-xl py-1 font-bold">Style&nbsp;:</h4>
                <p class="text-xl ms-2 bg-gray-300 px-2 rounded">food</p>
                <p class="text-xl ms-2 px-2 bg-gray-300 rounded">solo</p>
                <p class="text-xl ms-2 px-2 bg-gray-300 rounded">nature</p>
            </div>

            <!-- plan name -->
            <div class="flex pt-1 items-center">
                <h4 class="text-xl font-bold">Plan&nbsp;:</h4>
                <p class="text-xl ms-2">eat humburg in Copenhagen</p>
            </div>

            <!-- description -->
            <div class="flex pt-1 items-start">
                <h4 class="text-xl font-bold">description&nbsp;:</h4>
                <p class="text-base ms-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam mollitia eius, commodi recusandae maxime eum error delectus repellat aspernatur cum quo, nemo fugiat enim hic soluta necessitatibus? Debitis, voluptates exercitationem?</p>
            </div>
        </div>
    </div>
</x-app-layout>