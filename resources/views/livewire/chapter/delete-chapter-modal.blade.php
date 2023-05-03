<div>
    <x-dialog-modal id="delete-chapter-modal" wire:model="show">
        @slot('title')
            {{ __('Delete chapter') }}
        @endslot

        @slot('content')
            <p>{{ __('Are you sure you want to delete the chapter?') }}</p>
            <p class="text-sm text-gray-500 pl-4 pt-1">
                *{{ __('The chapter will be completely eliminated from the system.') }}
            </p>
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
</div>
