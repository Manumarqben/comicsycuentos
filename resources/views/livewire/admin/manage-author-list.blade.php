<div class="container">
    <x-slot name="header">
        <h2 class="h2">
            {{ __('Authors administration') }}
        </h2>
    </x-slot>

    @empty($authors)
        <div class="flex justify-center h2">
            {{ __('There are no authors in the application.') }}
        </div>
    @else
        <table class="w-full">
            <thead>
                <th class="sm:text-left sm:px-4">{{ __('Alias') }}</th>
                <th>{{ __('Actions') }}</th>
            </thead>
            <tbody>
                @foreach ($authors as $author)
                    <x-admin-row row="{{ $loop->index }}"
                        wire:key="author-{{ $author->id }}">
                        <td class="p-4 w-full">
                            <div class="flex justify-center sm:justify-start w-full">
                                {{ $author->alias }}
                            </div>
                        </td>
                        <td class="p-4">
                            <div class="flex flex-row justify-center space-x-1">
                                <x-button
                                    wire:click.prevent="redirectToAdminAuthor('{{ $author->id }}')">
                                    <x-icon.edit />
                                </x-button>
                                <x-danger-button
                                    wire:click.prevent="openDeleteModal({{ $author->id }})">
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
        {{ $authors->links('livewire.paginator') }}
    </div>

    <x-dialog-modal id="delete" wire:model="showDeleteModal">
        @slot('title')
            {{ __('Delete author') }}
        @endslot

        @slot('content')
            <p>
                {{ __("Are you sure you want to eliminate author $alias?") }}
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
