<div class="container">
    <x-slot name="header">
        <h2 class="h2">
            {{ __('Application administration') }}
        </h2>
    </x-slot>

    @empty($applicants)
        <div class="flex justify-center h2">
            {{ __('There are no pending applications.') }}
        </div>
    @else
        <table class="w-full">
            <thead>
                <th class="sm:text-left sm:px-4">{{ __('Alias') }}</th>
                <th>{{ __('Actions') }}</th>
            </thead>
            <tbody>
                @foreach ($applicants as $applicant)
                    <x-admin-row row="{{ $loop->index }}"
                        wire:key="applicant-{{ $applicant->id }}">
                        <td class="p-4 w-full">
                            <div class="flex justify-center sm:justify-start w-full">
                                {{ $applicant->alias }}
                            </div>
                        </td>
                        <td class="p-4">
                            <div class="flex flex-row justify-center">
                                <x-button
                                    wire:click.prevent="openAcceptModal({{ $applicant->id }})">
                                    <x-icon.check />
                                </x-button>
                                <x-danger-button
                                    wire:click.prevent="openDeleteModal({{ $applicant->id }})">
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
