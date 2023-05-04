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
                                        wire:click="$emitTo('work.delete-work-modal', 'open', [{{ $work->id }}])">
                                        <x-icon.trash />
                                    </x-danger-button>
                                    <a href="{{ route('chapter.create', $work->slug) }}"
                                        class="button">
                                        <x-icon.plus />
                                    </a>
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
                                            <a href="{{ route('chapter.update', ['workSlug' => $work->slug, 'chapterId' => $chapter->id]) }}"
                                                class="button-secondary">
                                                <x-icon.edit />
                                            </a>
                                            <x-danger-button
                                                wire:click="$emitTo('chapter.delete-chapter-modal', 'open', [{{ $chapter->id }}])">
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
    @livewire('work.delete-work-modal')
    @livewire('chapter.delete-chapter-modal')
</div>
