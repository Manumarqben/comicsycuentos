<div>
    <x-action-section>
        <x-slot name="title">
            {{ __('Works list') }}
        </x-slot>
        <x-slot name="description">
            {{ __('List of works to manage.') }}
        </x-slot>
        <x-slot name="content">
            <div class="flex justify-end">
                <a href="{{ route('work.create') }}" class="button">
                    {{ __('Create new work') }}
                </a>
            </div>
            @if ($author->works->count() > 0)
                <div
                    class="w-full flex flex-col max-h-[500px] overflow-y-auto mt-4">
                    @foreach ($author->works as $work)
                        <div
                            class="flex flex-col sm:flex-row justify-center rounded-lg hover:drop-shadow-xl p-3">
                            <div
                                class="flex items-center justify-center sm:justify-start cursor-pointer w-full">
                                <p class="line-clamp-1">
                                    {{ $work->title }}</p>
                            </div>
                            <div class="flex flex-row justify-center">
                                <a href="{{ route('work.update', $work->slug) }}"
                                    class="button">
                                    <x-icon.edit />
                                </a>
                                <x-danger-button
                                    wire:click="$emitTo('work.delete-work-modal', 'open', [{{ $work->id }}])">
                                    <x-icon.trash />
                                </x-danger-button>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </x-slot>
    </x-action-section>
    @livewire('work.delete-work-modal')
</div>
