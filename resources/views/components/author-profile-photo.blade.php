@props(['path', 'alt'])

<div
class="h-52 sm:h-64 w-52 sm:w-64 rounded-full overflow-hidden border-4 border-gray-500">
<img class="object-cover w-full h-full"
    src="{{ $path }}"
    alt="{{ $alt }}" />
</div>