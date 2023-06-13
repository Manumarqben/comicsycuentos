<div>
    <div class="flex justify-end">
        <x-button wire:click.prevent="openSaveModal">
            {{ __('Create new genre') }}
        </x-button>
    </div>
    @empty($genres)
        <div class="flex justify-center h2">
            {{ __('There are no genres in the app.') }}
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
                @foreach ($genres as $genre)
                    <x-admin-row row="{{ $loop->index }}"
                        wire:key="genre-{{ $genre->id }}">
                        <td class="p-4">
                            <div class="flex justify-center sm:justify-start w-full">
                                {{ $genre->name }}
                            </div>
                        </td>
                        <td class="hidden sm:table-cell p-4 w-full">
                            <span class="line-clamp-1">
                                {{ $genre->description }}
                            </span>
                        </td>
                        <td class="p-4">
                            <div class="flex flex-row justify-center space-x-1">
                                <x-button
                                    wire:click.prevent="openSaveModal({{ $genre->id }})">
                                    <x-icon.edit />
                                </x-button>
                                <x-danger-button
                                    wire:click.prevent="openDeleteModal({{ $genre->id }})">
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
        {{ $genres->links('livewire.paginator') }}
    </div>

    <x-dialog-modal id="delete" wire:model="showDeleteModal">
        @slot('title')
            {{ __('Delete genre') }}
        @endslot

        @slot('content')
            <p>
                {{ __("Are you sure you want to eliminate genre $name?") }}
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
            {{ __('Save genre') }}
        @endslot
        @slot('content')
            <x-form submit="save">
                @slot('form')
                    <div class="col-span-6">
                        <div>
                            <x-label for="name">Alias</x-label>
                            <x-input id="name" type="text" name="name"
                                class="block w-full {{ $errors->any() ? 'is-invalid' : '' }}"
                                wire:model.defer="genreTo.name" />
                            <x-input-error for="genreTo.name" />
                            @if (!$errors->has('genreTo.name'))
                                <x-input-error for="genreTo.slug" />
                            @endif
                        </div>
                        <div>
                            <x-label for="description">Description</x-label>
                            <x-textarea id="description" type="text" name="description"
                                class="block w-full {{ $errors->any() ? 'is-invalid' : '' }}"
                                wire:model.defer="genreTo.description" />
                            <x-input-error for="genreTo.description" />
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
