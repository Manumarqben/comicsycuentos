<div class="container">
    <x-slot name="header">
        <h2 class="h2">
            {{ __('User administration') }}
        </h2>
    </x-slot>
    @foreach ($users as $user)
        <x-admin-row @class([
            'bg-gray-300' => $loop->index % 2 === 0,
            'dark:bg-gray-600' => $loop->index % 2 === 0,
        ])
            wire:key="user-{{ $user->id }}">
            {{ $user->name }}
            @slot('actions')
                <x-button
                    wire:click.prevent="redirectToAdminUser('{{ $user->id }}')">
                    <x-icon.edit />
                </x-button>
                <x-danger-button
                    wire:click.prevent="openDeleteModal({{ $user->id }})">
                    <x-icon.trash />
                </x-danger-button>
                @if ($user->admin)
                    <x-secondary-button
                        wire:click.prevent="openDeleteAdminModal({{ $user->id }})"
                        title="Degradar de administrador">
                        <x-icon.arrow-down-circle />
                    </x-secondary-button>
                @else
                    <x-secondary-button
                        wire:click.prevent="openCreateAdminModal({{ $user->id }})"
                        title="Ascender a administrador">
                        <x-icon.arrow-up-circle />
                    </x-secondary-button>
                @endif
            @endslot
        </x-admin-row>
    @endforeach
    <div class="pt-4">
        {{ $users->links('livewire.paginator') }}
    </div>

    <x-dialog-modal id="delete" wire:model="showDeleteModal">
        @slot('title')
            {{ __('Delete user') }}
        @endslot

        @slot('content')
            <p>
                {{ __("Are you sure you want to eliminate user $name?") }}
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

    <x-dialog-modal id="admin" wire:model="showCreateAdminModal">
        @slot('title')
            {{ __('Turn user into administrator') }}
        @endslot

        @slot('content')
            <p>
                {{ __("Are you sure you want to ascend to the user $name?") }}
            </p>
        @endslot
        @slot('footer')
            <x-secondary-button wire:click="$toggle('showCreateAdminModal')">
                {{ __('Cancel') }}
            </x-secondary-button>
            <x-button wire:click.prevent="ascendToAdmin"
                wire:loading.attr="disabled">
                {{ __('Accept') }}
            </x-button>
        @endslot
    </x-dialog-modal>

    <x-dialog-modal id="admin" wire:model="showDeleteAdminModal">
        @slot('title')
            {{ __('Turn user into administrator') }}
        @endslot

        @slot('content')
            <p>
                {{ __("Are you sure you want to degrade the administrator $name?") }}
            </p>
        @endslot
        @slot('footer')
            <x-secondary-button wire:click="$toggle('showDeleteAdminModal')">
                {{ __('Cancel') }}
            </x-secondary-button>
            <x-danger-button wire:click.prevent="degradeToUser"
                wire:loading.attr="disabled">
                {{ __('Delete') }}
            </x-danger-button>
        @endslot
    </x-dialog-modal>
</div>
