<div class="container">
    <x-slot name="header">
        <h2 class="h2">
            {{ __('Application administration') }}
        </h2>
    </x-slot>
    @forelse ($applicants as $applicant)
        <x-admin-row @class([
            'bg-gray-300' => $loop->index % 2 === 0,
            'dark:bg-gray-600' => $loop->index % 2 === 0,
        ])
            wire:key="applicant-{{ $applicant->id }}">
            {{ $applicant->alias }}
            @slot('actions')
                <x-button wire:click.prevent="openAcceptModal({{ $applicant->id }})">
                    <x-icon.check />
                </x-button>
                <x-danger-button
                    wire:click.prevent="openDeleteModal({{ $applicant->id }})">
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
        {{ $applicants->links('livewire.paginator') }}
    </div>

    <x-dialog-modal id="delete" wire:model="showDeleteModal">
        @slot('title')
            {{ __('Delete applicant') }}
        @endslot

        @slot('content')
            <p>
                {{ __("Are you sure you want to eliminate applicant $alias?") }}
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

    <x-dialog-modal id="accept" wire:model="showAcceptModal">
        @slot('title')
            {{ __('Accept applicant') }}
        @endslot

        @slot('content')
            <p>
                {{ __("Are you sure you want to accept the $alias apply as an author?") }}
            </p>
        @endslot
        @slot('footer')
            <x-secondary-button wire:click="$toggle('showAcceptModal')">
                {{ __('Cancel') }}
            </x-secondary-button>
            <x-button wire:click.prevent="acceptAsAuthor"
                wire:loading.attr="disabled">
                {{ __('Accept') }}
            </x-button>
        @endslot
    </x-dialog-modal>
</div>
