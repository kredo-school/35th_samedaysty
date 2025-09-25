
@props(['status' => null])

<ol class="flex items-center w-full p-3 space-x-2 text-sm font-medium text-center text-gray-500 bg-white border border-gray-200 rounded-lg shadow-xs dark:text-gray-400 sm:text-base dark:bg-gray-800 dark:border-gray-700 sm:p-4 sm:space-x-4 rtl:space-x-reverse mt-3">
    <li class="flex items-center text-blue-600 dark:text-blue-500">
        <span class="flex items-center justify-center w-5 h-5 me-2 text-xs border border-blue-600 rounded-full shrink-0 dark:border-blue-500">
            1
        </span>
        Send a join request <span class="hidden sm:inline-flex sm:ms-2"></span>
        <svg class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 12 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m7 9 4-4-4-4M1 9l4-4-4-4"/>
        </svg>
    </li>
    <li class="flex items-center {{ in_array($status, ['pending', 'declined', 'accepted']) ? 'text-blue-600 dark:text-blue-500' : '' }}">
        <span class="flex items-center justify-center w-5 h-5 me-2 text-xs border rounded-full shrink-0 {{ in_array($status, ['pending','declined','accepted']) ? 'border-blue-600 dark:border-blue-500' : 'border-gray-500 dark:border-gray-400' }}">
            2
        </span>
        Pending <span class="hidden sm:inline-flex sm:ms-2"></span>
        <svg class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 12 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m7 9 4-4-4-4M1 9l4-4-4-4"/>
        </svg>
    </li>
    <li class="flex items-center {{ $status === 'accepted' ? 'text-blue-600 dark:text-blue-500' : '' }}">
        <span class="flex items-center justify-center w-5 h-5 me-2 text-xs border rounded-full shrink-0 {{ $status === 'accepted' ? 'border-blue-600 dark:border-blue-500' : 'border-gray-500 dark:border-gray-400' }}">
            3
        </span>
        Joined (accepted)
    </li>
</ol>

