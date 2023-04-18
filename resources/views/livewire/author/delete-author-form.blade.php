<x-action-section>
    <x-slot name="title">
        {{ __('Delete Author') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Permanently delete author.') }}
    </x-slot>

    <x-slot name="content">
        <div class="max-w-xl text-sm text-gray-600 dark:text-gray-400">
            {{ __("If the author is eliminated all the author's information and his works will be eliminated.") }}
        </div>

        <div class="mt-5">
            <x-danger-button wire:click="$toggle('show')"
                wire:loading.attr="disabled">
                {{ __('Delete Author') }}
            </x-danger-button>
        </div>

        <x-dialog-modal id="delete" wire:model="show">
            @slot('title')
                {{ __('Delete author') }}
            @endslot

            @slot('content')
                <p>
                    {{ __("Are you sure you want to eliminate author $author->alias?") }}
                </p>
                <p class="text-sm text-gray-500 pl-4 pt-1">
                    *{{ __('All information and works will be deleted.') }}
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
    </x-slot>
</x-action-section>
