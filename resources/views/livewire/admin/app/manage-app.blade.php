<div class="container">
    <x-slot name="header">
        <h2 class="h2">
            {{ __('App administration') }}
        </h2>
    </x-slot>
    <div class="flex flex-wrap sm:flex-nowrap justify-around p-2">
        <x-tab-option wire:click.prevent="$set('manage', 'genres')"
            :active="$manage == 'genres'" class="w-1/2 sm:w-full">
            Genres
        </x-tab-option>
        <x-tab-option wire:click.prevent="$set('manage', 'states')"
            :active="$manage == 'states'" class="w-1/2 sm:w-full">
            States
        </x-tab-option>
        <x-tab-option wire:click.prevent="$set('manage', 'types')"
            :active="$manage == 'types'" class="w-1/2 sm:w-full">
            Types
        </x-tab-option>
        <x-tab-option wire:click.prevent="$set('manage', 'ages')"
            :active="$manage == 'ages'" class="w-1/2 sm:w-full">
            Ages
        </x-tab-option>
        <x-tab-option wire:click.prevent="$set('manage', 'ranges')"
            :active="$manage == 'ranges'" class="w-1/2 sm:w-full">
            Age ranges
        </x-tab-option>
        <x-tab-option wire:click.prevent="$set('manage', 'markers')"
            :active="$manage == 'markers'" class="w-1/2 sm:w-full">
            Markers
        </x-tab-option>
    </div>

    <div class="flex justify-center items-center w-full">
        <div wire:loading class="p-3">
            <x-loading-spin wire:loading wire:target="manage" />
        </div>
    </div>

    <div wire:loading.remove>
        @if ($manage == 'genres')
            @livewire('admin.app.manage-genres')
        @endif
        @if ($manage == 'states')
            @livewire('admin.app.manage-states')
        @endif
        @if ($manage == 'types')
            @livewire('admin.app.manage-types')
        @endif
        @if ($manage == 'ages')
            @livewire('admin.app.manage-ages')
        @endif
        @if ($manage == 'ranges')
            @livewire('admin.app.manage-age-ranges')
        @endif
        @if ($manage == 'markers')
            @livewire('admin.app.manage-markers')
        @endif
    </div>
</div>
