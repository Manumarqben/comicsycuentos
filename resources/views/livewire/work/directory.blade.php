<div>
    <x-slot name="header">
        <h2 class="h2">
            {{ __('Works directory') }}
        </h2>
    </x-slot>
    <div class="container">
        <div class="w-full">
            <x-form submit="submitSearch">
                @slot('form')
                    <div class="col-span-6">
                        <x-input type="text" placeholder="Search..."
                            wire:model.defer="search" class="w-full"
                            wire:keydown.enter="submitSearch" />
                        <div x-data="{ open: false }" class="pt-1">
                            <div class="w-full flex justify-end items-center">
                                <span @click="open = !open">Busqueda avanzada</span>
                                <template x-if="open">
                                    <x-icon.chevron-up type="mini" />
                                </template>
                                <template x-if="!open">
                                    <x-icon.chevron-down type="mini" />
                                </template>
                            </div>
                            <div x-show="open" class="pt-1">
                                <div
                                    class="flex flex-col sm:flex-row justify-between items-center gap-1">
                                    <div class="w-full">
                                        <x-label for="stateSelector">
                                            States
                                        </x-label>
                                        <select id="stateSelector"
                                            wire:model.defer="state"
                                            class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full">
                                            <option value="" selected>
                                                {{ __('See all states') }}
                                            </option>
                                            @foreach ($states as $slug => $name)
                                                <option value="{{ $slug }}"
                                                    wire:key="state-{{ $slug }}">
                                                    {{ $name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="w-full">
                                        <x-label for="typeSelector">
                                            Types
                                        </x-label>
                                        <select id="typeSelector"
                                            wire:model.defer="type"
                                            class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full">
                                            <option value="" selected>
                                                {{ __('See all types') }}
                                            </option>
                                            @foreach ($types as $slug => $name)
                                                <option value="{{ $slug }}"
                                                    wire:key="type-{{ $slug }}">
                                                    {{ $name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="w-full">
                                        <x-label for="ageSelector">
                                            Ages
                                        </x-label>
                                        <select id="ageSelector"
                                            wire:model.defer="age"
                                            class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full">
                                            <option value="" selected>
                                                {{ __('See all ages') }}
                                            </option>
                                            @foreach ($ages as $year)
                                                <option value="{{ $year }}"
                                                    wire:key="type-{{ $year }}">
                                                    {{ $year == 0 ? 'TP' : '+' . $year }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div id="genres" class="pt-2">
                                    <x-label>Genres</x-label>
                                    <div class="flex flex-col sm:flex-row gap-3">
                                        @foreach ($genres as $slug => $genre)
                                            <div>
                                                <input type="checkbox"
                                                    id="{{ $genre }}"
                                                    value="{{ $slug }}"
                                                    wire:model.defer="selectedGenres">
                                                <label for="{{ $genre }}"
                                                    wire:key="genre-{{ $slug }}">
                                                    {{ $genre }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endslot
                @slot('actions')
                    <x-secondary-button wire:click.prevent="resetData">
                        Reset
                    </x-secondary-button>
                    <x-button>
                        Search
                    </x-button>
                @endslot
            </x-form>
        </div>
        @livewire('work.list-works', key('list-directory'))
    </div>
</div>
