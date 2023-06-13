<div>
    <div class="flex justify-end">
        <x-button wire:click.prevent="openSaveModal">
            {{ __('Create new age') }}
        </x-button>
    </div>
    @empty($ages)
        <div class="flex justify-center h2">
            {{ __('There are no ages in the app.') }}
        </div>
    @else
        <table class="w-full">
            <thead>
                <tr>
                    <th>{{ __('Year') }}</th>
                    <th class="hidden sm:table-cell">{{ __('Description') }}</th>
                    <th>{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ages as $age)
                    <x-admin-row row="{{ $loop->index }}"
                        wire:key="age-{{ $age->id }}">
                        <td class="p-4">
                            <div class="flex justify-center sm:justify-start w-full">
                                {{ $age->year }}
                            </div>
                        </td>
                        <td class="hidden sm:table-cell p-4 w-full">
                            <span class="line-clamp-1">
                                {{ $age->description }}
                            </span>
                        </td>
                        <td class="p-4">
                            <div class="flex flex-row justify-center space-x-1">
                                <x-button
                                    wire:click.prevent="openSaveModal({{ $age->id }})">
                                    <x-icon.edit />
                                </x-button>
                                <x-danger-button
                                    wire:click.prevent="openDeleteModal({{ $age->id }})">
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
        {{ $ages->links('livewire.paginator') }}
    </div>

    <x-dialog-modal id="delete" wire:model="showDeleteModal">
        @slot('title')
            {{ __('Delete age') }}
        @endslot

        @slot('content')
            <p>
                {{ __("Are you sure you want to eliminate age $year?") }}
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
            {{ __('Save age') }}
        @endslot
        @slot('content')
            <x-form submit="save">
                @slot('form')
                    <div class="col-span-6">
                        <div>
                            <x-label for="age">Year</x-label>
                            <x-input id="age" type="number" name="age"
                                class="block w-full {{ $errors->any() ? 'is-invalid' : '' }}"
                                wire:model.defer="ageTo.year" />
                            <x-input-error for="ageTo.year" />
                        </div>
                        <div>
                            <x-label for="description">Description</x-label>
                            <x-textarea id="description" type="text" name="description"
                                class="block w-full {{ $errors->any() ? 'is-invalid' : '' }}"
                                wire:model.defer="ageTo.description" />
                            <x-input-error for="ageTo.description" />
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
