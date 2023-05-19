<div class="container">
    <x-slot name="header">
        <h2 class="h2">
            {{ __('Library') }}
        </h2>
    </x-slot>
    <div class="flex justify-around p-2">
        <x-tab-option
            wire:click="setMarker('finished')"
            :active="$marker == 'finished'"
            class="w-full">
            {{ __('Finished') }}
        </x-tab-option>
        <x-tab-option
            wire:click="setMarker('following')"
            :active="$marker == 'following'"
            class="w-full">
            {{ __('Following') }}
        </x-tab-option>
        <x-tab-option
            wire:click="setMarker('pending')"
            :active="$marker == 'pending'"
            class="w-full">
            {{ __('Pending') }}
        </x-tab-option>
        <x-tab-option
            wire:click="setMarker('favorite')"
            :active="$marker == 'favorite'"
            class="w-full">
            {{ __('Favorites') }}
        </x-tab-option>
    </div>

    <div class="pt-4">
        @livewire('work.list-works', ['marker' => $marker], key('list-library'))
    </div>
</div>
