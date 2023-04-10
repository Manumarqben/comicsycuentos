<div class="container">
    <x-slot name="header">
        <h2 class="h2">
            {{ __('Library') }}
        </h2>
    </x-slot>
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

    @livewire('work.list-works', ['marker' => $marker], key('list-library'))
</div>
