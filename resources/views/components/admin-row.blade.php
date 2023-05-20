@props(['row'])

<tr @class([
    'bg-gray-300' => $row % 2 === 0,
    'dark:bg-gray-600' => $row % 2 === 0,
])>
    {{ $slot }}
</tr>
