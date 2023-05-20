<div>
    <div class="flex justify-end">
        <x-button wire:click.prevent="openSaveModal">
            {{ __('Create new state') }}
        </x-button>
    </div>
    @empty($states)
    <div class="flex justify-center h2">
        {{ __('There are no states in the app.') }}
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
            @foreach ($states as $state)
                <x-admin-row row="{{ $loop->index }}"
                    wire:key="state-{{ $state->id }}">
                    <td class="p-4">
                        <div class="flex justify-center sm:justify-start w-full">
                            {{ $state->name }}
                        </div>
                    </td>
                    <td class="hidden sm:table-cell p-4 w-full">
                        <span class="line-clamp-1">
                            {{ $state->description }}
                        </span>
                    </td>
                    <td class="p-4">
                        <div class="flex flex-row justify-center">
                            <x-button
                                wire:click.prevent="openSaveModal({{ $state->id }})">
                                <x-icon.edit />
                            </x-button>
                            <x-danger-button
                                wire:click.prevent="openDeleteModal({{ $state->id }})">
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
        {{ $states->links('livewire.paginator') }}
    </div>

    <x-dialog-modal id="delete" wire:model="showDeleteModal">
        @slot('title')
            {{ __('Delete state') }}
        @endslot

        @slot('content')
            <p>
                {{ __("Are you sure you want to eliminate state $name?") }}
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
            {{ __('Save state') }}
        @endslot
        @slot('content')
            <x-form submit="save">
                @slot('form')
                    <div class="col-span-6">
                        <div>
                            <x-label for="name">Name</x-label>
                            <x-input id="name" type="text" name="name"
                                class="block w-full {{ $errors->any() ? 'is-invalid' : '' }}"
                                wire:model.defer="stateTo.name" />
                            <x-input-error for="stateTo.name" />
                            @if (!$errors->has('stateTo.name'))
                                <x-input-error for="stateTo.slug" />
                            @endif
                        </div>
                        <div>
                            <x-label for="description">Description</x-label>
                            <x-textarea id="description" type="text" name="description"
                                class="block w-full {{ $errors->any() ? 'is-invalid' : '' }}"
                                wire:model.defer="stateTo.description" />
                            <x-input-error for="stateTo.description" />
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
