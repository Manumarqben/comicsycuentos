<div class="container">
    <div id="data"
        class="flex flex-col sm:flex-row gap-3 items-center sm:items-start">
        <div id="card">
            <div class="relative h-80 w-64 sm:h-96 sm:w-72">
                <div id="type" class="absolute top-0 h-1/6 w-full">
                    <div
                        class="flex justify-center items-center h-full bg-white bg-opacity-90">
                        {{-- TODO: hacer que el bg dependa del tipo --}}
                        <p class="text-4xl font-bold text-gray-800">
                            {{ strToUpper($work->type->name) }}</p>
                    </div>
                </div>
                <div id="frontPage" class="h-full w-full">
                    <img class="object-cover w-full h-full"
                        src="{{ $work->front_page }}"
                        alt="{{ $work->title }}" />
                </div>
                <div id="age"
                    class="absolute bottom-0 right-0 h-1/6 aspect-square">
                    <div
                        class="flex justify-center items-center h-full bg-white bg-opacity-90">
                        {{-- TODO: hacer que el bd dependa del age --}}
                        <p class="text-2xl sm:text-3xl font-bold text-gray-800">
                            {{ $work->age->year == 0 ? 'TP' : '+' . $work->age->year }}
                        </p>
                    </div>
                </div>
                @auth
                    <div id="actions">
                        @livewire('work.favorite-button', ['id' => $work->id], key('fav-button'))
                    </div>
                @endauth
            </div>
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
                <x-button wire:click="setSortDirection">
                    @if ($sortDirection == 'desc')
                        desc
                    @else
                        asc
                    @endif
                </x-button>
            </div>
            @foreach ($this->chapters as $chapter)
                <div id="chapter-{{ $loop->iteration }}"
                    class="flex justify-between">
                    <a
                        href="{{ route('chapter.viewer', ['workSlug' => $work->slug, 'chapterNumber' => $chapter->number]) }}">
                        {{ "$chapter->number. $chapter->title" }}
                    </a>
                    @auth
                        @if ($chapter->number > 5)
                            <x-button>No Visto</x-button>
                        @else
                            <x-button>Visto</x-button>
                        @endif
                    @endauth
                </div>
            @endforeach
        @endif
        {{ $this->chapters->links('livewire.paginator') }}
    </div>
</div>
