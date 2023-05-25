<div class="flex items-center gap-3">
    @if ($like === true)
        <div wire:click="voted()">
            <x-icon.hand-thumb-up-solid />
        </div>
    @else
        <div wire:click="voted(true)">
            <x-icon.hand-thumb-up-outline />
        </div>
    @endif
    @if ($like === false)
        <div wire:click="voted()">
            <x-icon.hand-thumb-down-solid />
        </div>
    @else
        <div wire:click="voted(false)">
            <x-icon.hand-thumb-down-outline />
        </div>
    @endif
</div>
