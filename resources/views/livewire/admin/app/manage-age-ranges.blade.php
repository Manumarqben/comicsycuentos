<div>
    <div class="flex justify-end">
        <x-button wire:click.prevent="openSaveModal">
            {{ __('Create new range') }}
        </x-button>
    </div>
    @empty($ranges)
        <div class="flex justify-center h2">
            {{ __('There are no ranges in the app.') }}
        </div>
    @else
        <table class="table-fixed w-full">
            <thead>
                <tr>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Min') }}</th>
                    <th>{{ __('Max') }}</th>
                    <th>{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ranges as $range)
                    <x-admin-row row="{{ $loop->index }}"
                        wire:key="range-{{ $range->id }}">
                        <td class="p-4">
                            <div class="flex justify-center sm:justify-start">
                                {{ $range->name }}
                            </div>
                        </td>
                        <td class="p-4">
                            <div class="flex justify-center">
                                {{ $range->minAge->year }}
                            </div>
                        </td>
                        <td class="p-4">
                            <div class="flex justify-center">
                                {{ $range->maxAge->year }}
                            </div>
                        </td>
                        <td class="p-4">
                            <div class="flex flex-row flex-wrap justify-center space-x-1">
                                <x-button
                                    wire:click.prevent="openSaveModal({{ $range->id }})">
                                    <x-icon.edit />
                                </x-button>
                                <x-danger-button
                                    wire:click.prevent="openDeleteModal({{ $range->id }})">
                                    <x-icon.trash />
                                </x-danger-button>
                            </div>
                        </td>
                    </x-admin-row>
                @endforeach
            </tbody>
        </table>
    @endempty

    <div class="pt-4">
        {{ $ranges->links('livewire.paginator') }}
    </div>

    <x-dialog-modal id="delete" wire:model="showDeleteModal">
        @slot('title')
            {{ __('Delete range') }}
        @endslot

        @slot('content')
            <p>
                {{ __("Are you sure you want to eliminate range $name?") }}
            </p>
        @endslot
        @slot('footer')
            <x-secondary-button wire:click="$toggle('showDeleteModal')">
                {{ __('Cancel') }}
            </x-secondary-button>
            <x-danger-button wire:click.prevent="delete"
                wire:loading.attr="disabled">
                {{ __('Delete') }}
            </x-danger-button>
        @endslot
    </x-dialog-modal>

    <x-dialog-modal id="save" wire:model="showSaveModal">
        @slot('title')
            {{ __('Save range') }}
        @endslot
        @slot('content')
            <x-form submit="save">
                @slot('form')
                    <div class="col-span-6">
                        <div>
                            <x-label for="name">Name</x-label>
                            <x-input id="name" type="text" name="name"
                                class="block w-full {{ $errors->any() ? 'is-invalid' : '' }}"
                                wire:model.defer="ageRangeTo.name" />
                            <x-input-error for="ageRangeTo.name" />
                            @if (!$errors->has('ageRangeTo.name'))
                                <x-input-error for="ageRangeTo.slug" />
                            @endif
                        </div>
                        <div>
                            <x-label for="minAge">Minimum age</x-label>
                            <select name="minAge" id="minAge"
                                wire:model.defer="ageRangeTo.age_min"
                                class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full">
                                <option value="">{{ __('Select age') }}</option>
                                @foreach ($ages as $id => $year)
                                    <option value="{{ $id }}"
                                        wire:key="age-{{ $id }}">
                                        {{ $year . ' years' }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error for="ageRangeTo.age_min" />
                        </div>
                        <div>
                            <x-label for="maxAge">Maximum age</x-label>
                            <select name="maxAge" id="maxAge"
                                wire:model.defer="ageRangeTo.age_max"
                                class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full">
                                <option value="">{{ __('Select age') }}</option>
                                @foreach ($ages as $id => $year)
                                    <option value="{{ $id }}"
                                        wire:key="age-{{ $id }}">
                                        {{ $year . ' years' }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error for="ageRangeTo.age_max" />
                        </div>
                    </div>
                @endslot
            </x-form>
        @endslot
        @slot('footer')
            <x-secondary-button wire:click="$toggle('showSaveModal')">
                {{ __('Cancel') }}
            </x-secondary-button>
            <x-button wire:click.prevent="save" wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-button>
        @endslot
    </x-dialog-modal>
</div>
