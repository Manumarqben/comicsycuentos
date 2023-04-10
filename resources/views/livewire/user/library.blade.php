<div class="container">
    <div>
        <x-button wire:click="$emitTo('work.list-works', 'setMarker', 'finished')">
            {{ __('Finished') }}
        </x-button>
        <x-button wire:click="$emitTo('work.list-works', 'setMarker', 'following')">
            {{ __('Following') }}
        </x-button>
        <x-button wire:click="$emitTo('work.list-works', 'setMarker', 'pending')">
            {{ __('Pending') }}
        </x-button>
    </div>

    @livewire('work.list-works', key('list-library'))
</div>
