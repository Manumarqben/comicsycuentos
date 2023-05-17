<div class="container">
    <x-slot name="header">
        <h2 class="h2">
            {{ __('Authors administration') }}
        </h2>
    </x-slot>
    @forelse ($authors as $author)
        <x-admin-row @class([
            'bg-gray-300' => $loop->index % 2 === 0,
            'dark:bg-gray-600' => $loop->index % 2 === 0,
        ])
            wire:key="author-{{ $author->id }}">
            {{ $author->alias }}
            @slot('actions')
                <x-danger-button
                    wire:click.prevent="openDeleteModal({{ $author->id }})">
                    <x-icon.trash />
                </x-danger-button>
            @endslot
        </x-admin-row>
    @empty
        <div class="flex justify-center h2">
            {{ __('There are no pending applications.') }}
        </div>
    @endforelse
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
