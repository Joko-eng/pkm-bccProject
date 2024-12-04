@props(['active' => false])

<a {{ $attributes }}
    class="flex items-center p-2 text-base font-medium {{ $active ? 'active-sidebar-item' : 'text-gray-900 hover:bg-gray-100'}} rounded-lg dark:text-white dark:hover:bg-gray-700 group"
    aria-current="{{ $active ? 'page' : false }}">
    <svg class="w-6 h-6 {{ $active ? 'text-white' : 'text-gray-800' }} dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v5m-3 0h6M4 11h16M5 15h14a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v9a1 1 0 0 0 1 1Z"/>
    </svg>
    <span class="ml-3">{{ $slot }}</span>
</a>
