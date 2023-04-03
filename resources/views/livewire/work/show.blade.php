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
            </div>
        </div>
        <div id="info" class="grow">
            <div id="title"
                class="text-2xl sm:text-4xl text-center sm:text-left line-clamp-1">
                {{ $work->title }}
            </div>
            <div id="synopsis" class="line-clamp-6">
                <p>{{ __('Synopsis') }}:</p>
                {{ $work->synopsis }}
            </div>
            <div id="state">
                {{ __('State') }}:
                {{ $work->state->name }}
            </div>
            <div id="genres">
                <p>{{ __('Genres') }}:</p>
                <div class="line-clamp-2">
                    @foreach ($work->genres as $genre)
                        {{ $genre->name }}
                    @endforeach
                </div>
            </div>
            <div id="author">
                {{ __('Author') }}:
                {{ $work->author->alias }}
            </div>
        </div>
    </div>
    <x-section-border />
    <div id="chapters" class="flex flex-col">
        <div class="ml-auto">
            <x-button wire:click="setSortDirection">
                @if ($sortDirection == 'desc')
                    desc
                @else
                    asc
                @endif
            </x-button>
        </div>
        @forelse ($this->chapters as $chapter)
            <div class="flex justify-between">
                {{ "$chapter->number. $chapter->title" }}
                <x-button>Leer</x-button>
            </div>
        @empty
            <div class="flex justify-center h2">
                {{ __('There is still no chapters') }}
            </div>
        @endforelse
        {{ $this->chapters->links() }}
    </div>
</div>
