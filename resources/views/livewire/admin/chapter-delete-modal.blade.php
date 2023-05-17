<x-dialog-modal id="delete-chapter-modal" wire:model="show">
    @slot('title')
        {{ __('Delete chapter') }}
    @endslot

    @slot('content')
        <p>{{ __('Are you sure you want to delete the chapter?') }}</p>
    @endslot
    @slot('footer')
        <x-secondary-button wire:click="$toggle('show')">
            {{ __('Cancel') }}
        </x-secondary-button>
        <x-danger-button wire:click="delete" wire:loading.attr="disabled">
            {{ __('Delete') }}
        </x-danger-button>
    @endslot
</x-dialog-modal>