<div class="container">
    <div id="data"
        class="flex flex-col sm:flex-row gap-3 items-center sm:items-start">
        <div id="card">
            <x-work-information-card
                frontPage="{{ asset(Storage::url($work->front_page)) }}"
                imgAlt="{{ $work->title }}">
                @slot('type')
                    {{ strToUpper($work->type->name) }}
                @endslot
                @slot('age')
                    {{ $work->age->year == 0 ? 'TP' : '+' . $work->age->year }}
                @endslot
            </x-work-information-card>
            @auth
                <div id="actions" class="flex">
                    @livewire('work.marker-selector', ['id' => $work->id], key('marker-selector'))
                    @livewire('work.favorite-button', ['id' => $work->id], key('fav-button'))
                </div>
            @endauth
        </div>
        <div id="info" class="grow space-y-2 px-5">
            <div id="title"
                class="text-2xl sm:text-4xl text-center sm:text-left line-clamp-1">
                {{ $work->title }}
            </div>
            <div id="synopsis" class="line-clamp-[9] sm:line-clamp-6 ">
                <div class="text-justify">{{ $work->synopsis }}</div>
            </div>
            <div id="state">
                <p class="font-bold text-lg">{{ __('State') }}:</p>
                {{ $work->state->name }}
            </div>
            <div id="genres">
                <p class="font-bold text-lg">{{ __('Genres') }}:</p>
                <div class="line-clamp-2 ">
                    @foreach ($work->genres as $genre)
                        {{ $genre->name }}
                    @endforeach
                </div>
            </div>
            <div id="author">
                <p class="font-bold text-lg">{{ __('Author') }}:</p>
                <a href="{{ route('author.show', $work->author->slug) }}">
                    {{ $work->author->alias }}
                </a>
            </div>
        </div>
    </div>
    <div id="border" class="py-8 px-3">
        <div class="border-t border-gray-200 dark:border-gray-700"></div>
    </div>
    <div id="chapters" class="flex flex-col">
        @if ($this->chapters->isEmpty())
            <div class="flex justify-center h2">
                {{ __('There is still no chapters') }}
            </div>
        @else
            <div class="ml-auto pb-5">
                <x-button wire:click="setSortDirection" class="text-red-800">
                    @if ($sortDirection == 'desc')
                        <x-icon.bars-arrow-down />
                    @else
                        <x-icon.bars-arrow-up />
                    @endif
                </x-button>
            </div>
            @foreach ($this->chapters as $chapter)
                <div id="chapter-{{ $chapter->id }}"
                    class="flex justify-between">
                    <a
                        href="{{ route('chapter.viewer', ['workSlug' => $work->slug, 'chapterNumber' => $chapter->number]) }}">
                        {{ "$chapter->number. $chapter->title" }}
                    </a>
                    @auth
                        <div
                            wire:click="bookmarkTo({{ $chapter->id }})">
                            @if ($chapter->number <= $lastChapterRead)
                                <div title="Marcar como ultimo capítulo leido">
                                    <x-icon.eye />
                                </div>
                            @else
                                <div wire:click="bookmarkTo({{ $chapter->id }})"
                                    title="Marcar como leido">
                                    <x-icon.eye-slash />
                                </div>
                            @endif
                        </div>
                    @endauth
                </div>
            @endforeach
        @endif
        {{ $this->chapters->links('livewire.paginator') }}
    </div>
</div>
