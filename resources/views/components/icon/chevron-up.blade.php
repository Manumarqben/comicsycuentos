@props(['type' => 'solid'])

@if ($type == 'solid')
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
        <path stroke-linecap="round" stroke-linejoin="round"
            d="M4.5 15.75l7.5-7.5 7.5 7.5" />
    </svg>
@endif
@if ($type == 'mini')
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
        fill="currentColor" class="w-5 h-5">
        <path fill-rule="evenodd"
            d="M14.77 12.79a.75.75 0 01-1.06-.02L10 8.832 6.29 12.77a.75.75 0 11-1.08-1.04l4.25-4.5a.75.75 0 011.08 0l4.25 4.5a.75.75 0 01-.02 1.06z"
            clip-rule="evenodd" />
    </svg>
@endif
