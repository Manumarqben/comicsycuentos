<div class="container">
    <div id="data"
        class="flex flex-col sm:flex-row gap-3 items-center sm:items-start pb-8">
        <div id="profilePhoto">
            <div
                class=" h-52 sm:h-64 w-52 sm:w-64 rounded-full overflow-hidden border-4 border-gray-500">
                <img class="object-cover w-full h-full"
                    src="{{ $author->profile_photo_path }}"
                    alt="{{ $author->alias }}" />
            </div>
        </div>
        <div id="info" class="grow space-y-2 px-5">
            <div id="alias"
                class="text-2xl sm:text-4xl text-center sm:text-left line-clamp-1">
                {{ $author->alias }}
            </div>
            <div id="biography" class="line-clamp-[9] sm:line-clamp-6 ">
                <div class="text-justify">{{ $author->biography }}</div>
            </div>
        </div>
    </div>
    <div>
        <div class="flex justify-between pb-8">
            <button wire:click="$emitTo('work.list-works', 'setState', 'publishing')">Publishing</button>
            <button wire:click="$emitTo('work.list-works', 'setState', 'finished')">Finished</button>
            <button wire:click="$emitTo('work.list-works', 'setState', 'hiatus')">Hiatus</button>
            <button wire:click="$emitTo('work.list-works', 'setState', 'discontinued')">Discontinued</button>
        </div>
        @livewire('work.list-works', ['author' => $author->id, 'state' => $state], key('list-works'))
    </div>
</div>
