<div class="container">
    <div id="data"
        class="flex flex-col sm:flex-row gap-3 items-center sm:items-start">
        <div id="card" class="rounded border-4 ">
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
            <div class="ml-auto pb-5 pr-2 flex">
                @auth
                    <x-danger-button wire:click="deleteBookmark" class="mr-2"
                        title="{{ __('Delete bookmarks') }}">
                        <x-icon.eye-slash />
                    </x-danger-button>
                @endauth
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
                    class="flex justify-between items-center p-4 hover:bg-gray-200 dark:hover:bg-gray-600 rounded">
                    <a href="{{ route('chapter.viewer', ['workSlug' => $work->slug, 'chapterNumber' => $chapter->number]) }}"
                        class="line-clamp-2">
                        {{ "$chapter->number. $chapter->title" }}
                    </a>
                    @auth
                        <div wire:click="bookmarkTo({{ $chapter->id }})">
                            @if ($chapter->number <= $lastChapterRead)
                                <div title="{{ __('Mark as last chapter read') }}"
                                    class="cursor-pointer text-blue-700 dark:text-blue-300">
                                    <x-icon.eye />
                                </div>
                            @else
                                <div
                                    title="{{ __('Mark as read') }}"
                                    class="cursor-pointer text-gray-500 ">
                                    <x-icon.eye-slash />
                                </div>
                            @endif
                        </div>
                    @endauth
                </div>
            @endforeach
        @endif
        @if ($this->chapters)
            <div class="pt-4">
                {{ $this->chapters->links('livewire.paginator') }}
            </div>
        @endif
    </div>
    @auth
        <x-dialog-modal id="info-bookmark-modal" wire:model="markerInfoModal">
            @slot('title')
                {{ __("You can't add bookmark") }}
            @endslot

            @slot('content')
                <p>{{ __('To use the bookmark, you must first have added the work to your library.') }}
                </p>
            @endslot
            @slot('footer')
                <x-button wire:click="$toggle('markerInfoModal')"
                    wire:loading.attr="disabled">
                    {{ __('Accept') }}
                </x-button>
            @endslot
        </x-dialog-modal>
    @endauth
</div>
