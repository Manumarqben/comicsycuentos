@props(['type' => 'solid'])

@if ($type == 'solid')
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
        class="w-6 h-6">
        <path d="M12 15a3 3 0 100-6 3 3 0 000 6z" />
        <path fill-rule="evenodd"
            d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 010-1.113zM17.25 12a5.25 5.25 0 11-10.5 0 5.25 5.25 0 0110.5 0z"
            clip-rule="evenodd" />
    </svg>
@endif
@if ($type == 'outline')
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
        <path stroke-linecap="round" stroke-linejoin="round"
            d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
        <path stroke-linecap="round" stroke-linejoin="round"
            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
    </svg>
@endif
@if ($type == 'mini')
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
        fill="currentColor" class="w-5 h-5">
        <path d="M10 12.5a2.5 2.5 0 100-5 2.5 2.5 0 000 5z" />
        <path fill-rule="evenodd"
            d="M.664 10.59a1.651 1.651 0 010-1.186A10.004 10.004 0 0110 3c4.257 0 7.893 2.66 9.336 6.41.147.381.146.804 0 1.186A10.004 10.004 0 0110 17c-4.257 0-7.893-2.66-9.336-6.41zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
            clip-rule="evenodd" />
    </svg>
@endif
