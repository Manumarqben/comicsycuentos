<div>
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
                            <div class="flex flex-row justify-center">
                                <x-button wire:click.prevent="">
                                    <x-icon.edit />
                                </x-button>
                                <x-danger-button wire:click.prevent="openDeleteModal({{ $genre->id }})">
                                    <x-icon.trash />
                                </x-danger-button>
                            </div>
                        </td>
                    </x-admin-row>
                @endforeach
            </tbody>
        </table>
    @endempty

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
</div>
