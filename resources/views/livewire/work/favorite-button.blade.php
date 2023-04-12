<div wire:click="fav">
    @if ($isFavorite)
        <x-icon.heart-solid class="w-12 h-12 text-red-500" />
    @else
        <x-icon.heart-outline class="w-12 h-12 text-red-500" />
    @endif
</div>
