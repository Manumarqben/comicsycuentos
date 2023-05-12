<div>
    <x-slot name="header">
        <h2 class="h2">
            {{ __('Works directory') }}
        </h2>
    </x-slot>
    <div class="container">
        <div class="w-full p-2">
            <div class="py-1">
            <x-input type="text" placeholder="Search..."
                wire:model.defer="search" class="w-full"
                wire:keydown.enter="submitSearch" />
            </div>
            <div class="flex flex-row justify-end gap-1">
                <x-secondary-button wire:click.prevent="resetData">
                    Reset
                </x-secondary-button>
                <x-button wire:click.prevent="submitSearch">
                    Search
                </x-button>
            </div>
        </div>
        @livewire('work.list-works', key('list-directory'))
    </div>
</div>
