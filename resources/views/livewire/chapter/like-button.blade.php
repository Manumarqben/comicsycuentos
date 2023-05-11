<div class="flex ">
    @if ($like === true)
        <div wire:click="voted()">
            <x-icon.hand-thumb-up-solid class="w-12 h-12 text-red-500" />
        </div>
    @else
        <div wire:click="voted(true)">
            <x-icon.hand-thumb-up-outline class="w-12 h-12 text-red-500" />
        </div>
    @endif
    @if ($like === false)
        <div wire:click="voted()">
            <x-icon.hand-thumb-down-solid class="w-12 h-12 text-red-500" />
        </div>
    @else
        <div wire:click="voted(false)">
            <x-icon.hand-thumb-down-outline class="w-12 h-12 text-red-500" />
        </div>
    @endif
</div>
