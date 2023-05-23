@props(['type' => 'solid'])

@if ($type == 'solid' || $type == 'outline')
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
        <path stroke-linecap="round" stroke-linejoin="round"
            d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
    </svg>
@endif
@if ($type == 'mini')
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
        fill="currentColor" class="w-5 h-5">
        <path fill-rule="evenodd"
            d="M17 10a.75.75 0 01-.75.75H5.612l4.158 3.96a.75.75 0 11-1.04 1.08l-5.5-5.25a.75.75 0 010-1.08l5.5-5.25a.75.75 0 111.04 1.08L5.612 9.25H16.25A.75.75 0 0117 10z"
            clip-rule="evenodd" />
    </svg>
@endif
