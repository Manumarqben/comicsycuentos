<div class="container">
    <div id="data"
        class="flex flex-col sm:flex-row gap-3 items-center sm:items-start pb-8">
        <div id="profilePhoto">
            <x-author-profile-photo
                path="{{ $author->profilePhoto
                    ? asset(Storage::url($author->profilePhoto->path))
                    : 'https://upload.wikimedia.org/wikipedia/commons/0/09/Cervantes_J%C3%A1uregui.jpg' }}"
                alt="{{ $author->alias }}" />
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
            <button
                wire:click="$emitTo('work.list-works', 'setState', 'publishing')">Publishing</button>
            <button
                wire:click="$emitTo('work.list-works', 'setState', 'finished')">Finished</button>
            <button
                wire:click="$emitTo('work.list-works', 'setState', 'hiatus')">Hiatus</button>
            <button
                wire:click="$emitTo('work.list-works', 'setState', 'discontinued')">Discontinued</button>
        </div>
        @livewire('work.list-works', ['author' => $author->id, 'state' => $state], key('list-works'))
    </div>
</div>
