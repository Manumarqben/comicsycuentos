<div class="container">
    <x-slot name="header">
        <h2 class="h2">
            {{ __('User administration') }}
        </h2>
    </x-slot>

    <table class="w-full">
        <thead>
            <th class="sm:text-left sm:px-4">{{ __('Name') }}</th>
            <th>{{ __('Actions') }}</th>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <x-admin-row row="{{ $loop->index }}"
                    wire:key="user-{{ $user->id }}">
                    <td class="p-4 w-full">
                        <div class="flex justify-center sm:justify-start w-full">
                            {{ $user->name }}
                        </div>
                    </td>
                    <td class="p-4">
                        <div class="flex flex-row justify-center">
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
                                    title="{{ __('Demote admin') }}">
                                    <x-icon.arrow-down-circle />
                                </x-secondary-button>
                            @else
                                <x-secondary-button
                                    wire:click.prevent="openCreateAdminModal({{ $user->id }})"
                                    title="{{ __('Promote to admin') }}">
                                    <x-icon.arrow-up-circle />
                                </x-secondary-button>
                            @endif
                        </div>
                    </td>
                </x-admin-row>
            @endforeach
        </tbody>
    </table>

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
