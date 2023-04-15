<div>
    <x-danger-button wire:click.prevent="$toggle('show')">
        {{ __('Withdraw') }}
    </x-danger-button>
    <x-dialog-modal id="delete" wire:model="show">
        @slot('title')
            {{ __('Delete application') }}
        @endslot

        @slot('content')
            <p>{{ __('Are you sure you want to delete the application?') }}</p>
        @endslot
        @slot('footer')
            <x-secondary-button wire:click="$toggle('show')">
                {{ __('Cancel') }}
            </x-secondary-button>
            <x-danger-button wire:click="delete" wire:loading.attr="disabled">
                {{ __('Withdraw') }}
            </x-danger-button>
        @endslot
    </x-dialog-modal>
</div>
