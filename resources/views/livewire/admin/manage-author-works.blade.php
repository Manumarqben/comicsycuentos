<div>
    <x-action-section>
        <x-slot name="title">
            {{ __('Works list') }}
        </x-slot>
        <x-slot name="description">
            {{ __('List of works to manage.') }}
        </x-slot>
        <x-slot name="content">
            @if ($author->works->count() > 0)
                <div
                    class="w-full flex flex-col max-h-[500px] overflow-y-auto mt-4">
                    @foreach ($author->works->sortBy('title') as $work)
                        {{-- TODO: crear componente para manejo de obra --}}
                        <div id="{{ 'work-' . $work->id }}"
                            x-data="{ open: false }">
                            <div
                                class="flex flex-col sm:flex-row justify-center rounded-lg hover:drop-shadow-xl p-3">
                                <div class="flex items-center justify-center sm:justify-start cursor-pointer w-full"
                                    @click="open = !open">
                                    <p class="line-clamp-1">
                                        {{ $work->title }}
                                    </p>
                                </div>
                                <div class="flex flex-row justify-center">
                                    <a href="{{ route('work.update', $work->slug) }}"
                                        class="button-secondary">
                                        <x-icon.edit />
                                    </a>
                                    <x-danger-button
                                        wire:click="$emitTo('admin.work-delete-modal', 'open', [{{ $work->id }}])">
                                        <x-icon.trash />
                                    </x-danger-button>
                                </div>
                            </div>
                            <div class="px-10 py-4" x-show="open">
                                @forelse ($work->chapters->sortBy('number')->reverse() as $chapter)
                                    <div
                                        class="flex flex-col sm:flex-row justify-center rounded-lg hover:drop-shadow-xl">
                                        <div
                                            class="flex items-center justify-center sm:justify-start cursor-pointer w-full">
                                            <p class="line-clamp-1">
                                                {{ "$chapter->number. $chapter->title" }}
                                            </p>
                                        </div>
                                        <div
                                            class="flex flex-row justify-center">
                                            <x-danger-button
                                                wire:click="$emitTo('admin.chapter-delete-modal', 'open', [{{ $chapter->id }}])">
                                                <x-icon.trash />
                                            </x-danger-button>
                                        </div>
                                    </div>
                                @empty
                                    <div class="flex justify-center h2">
                                        {{ __('This work still has no chapters.') }}
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </x-slot>
    </x-action-section>

    @livewire('admin.work-delete-modal')
    @livewire('admin.chapter-delete-modal')
</div>
