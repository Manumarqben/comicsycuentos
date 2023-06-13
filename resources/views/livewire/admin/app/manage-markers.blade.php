<div>
    <div class="flex justify-end">
        <x-button wire:click.prevent="openSaveModal">
            {{ __('Create new marker') }}
        </x-button>
    </div>
    @empty($markers)
    <div class="flex justify-center h2">
        {{ __('There are no markers in the app.') }}
    </div>
    @else
    <table class="w-full">
        <thead>
            <tr>
                <th>{{ __('Name') }}</th>
                <th class="hidden sm:table-cell">{{ __('Description') }}</th>
                <th>{{ __('Actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($markers as $marker)
                <x-admin-row row="{{ $loop->index }}"
                    wire:key="marker-{{ $marker->id }}">
                    <td class="p-4">
                        <div class="flex justify-center sm:justify-start w-full">
                            {{ $marker->name }}
                        </div>
                    </td>
                    <td class="hidden sm:table-cell p-4 w-full">
                        <span class="line-clamp-1">
                            {{ $marker->description }}
                        </span>
                    </td>
                    <td class="p-4">
                        <div class="flex flex-row justify-center space-x-1">
                            <x-button
                                wire:click.prevent="openSaveModal({{ $marker->id }})">
                                <x-icon.edit />
                            </x-button>
                            <x-danger-button
                                wire:click.prevent="openDeleteModal({{ $marker->id }})">
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
        {{ $markers->links('livewire.paginator') }}
    </div>

    <x-dialog-modal id="delete" wire:model="showDeleteModal">
        @slot('title')
            {{ __('Delete marker') }}
        @endslot

        @slot('content')
            <p>
                {{ __("Are you sure you want to eliminate marker $name?") }}
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
            {{ __('Save marker') }}
        @endslot
        @slot('content')
            <x-form submit="save">
                @slot('form')
                    <div class="col-span-6">
                        <div>
                            <x-label for="name">Name</x-label>
                            <x-input id="name" type="text" name="name"
                                class="block w-full {{ $errors->any() ? 'is-invalid' : '' }}"
                                wire:model.defer="markerTo.name" />
                            <x-input-error for="markerTo.name" />
                            @if (!$errors->has('markerTo.name'))
                                <x-input-error for="markerTo.slug" />
                            @endif
                        </div>
                        <div>
                            <x-label for="description">Description</x-label>
                            <x-textarea id="description" type="text" name="description"
                                class="block w-full {{ $errors->any() ? 'is-invalid' : '' }}"
                                wire:model.defer="markerTo.description" />
                            <x-input-error for="markerTo.description" />
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
