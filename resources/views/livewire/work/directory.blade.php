<div>
    <x-slot name="header">
        <h2 class="h2">
            {{ __('Works directory') }}
        </h2>
    </x-slot>
    <div class="container">
        <div class="w-full p-2">
            <x-form submit="submitSearch">
                @slot('form')
                    <div class="col-span-6">
                        <x-input type="text" placeholder="Search..."
                            wire:model.defer="search" class="w-full"
                            wire:keydown.enter="submitSearch" />
                    </div>
                    <div class="col-span-6">
                        {{-- TODO: ocultar este div para mostar opciones avanzadas de busqueda --}}
                        <div class="flex flex-col sm:flex-row justify-between items-center gap-1">
                            <select id="stateSelector" wire:model.defer="state"
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
