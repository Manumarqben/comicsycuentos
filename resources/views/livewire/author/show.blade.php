<div class="container">
    <div id="data"
        class="flex flex-col sm:flex-row gap-3 items-center sm:items-start pb-8">
        <div id="profilePhoto">
            <x-author-profile-photo
                path="{{ $author->profilePhoto
                    ? asset(Storage::url($author->profilePhoto->path))
                    : asset(Storage::url('author_profile_photos/cervantes.jpg')) }}"
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
        <div class="flex flex-wrap sm:flex-nowrap justify-around py-2">
            <x-tab-option wire:click.prevent="setState('publishing')"
                :active="$state == 'publishing'" class="w-1/2 sm:w-full">
                Publishing
            </x-tab-option>
            <x-tab-option wire:click.prevent="setState('finished')"
                :active="$state == 'finished'" class="w-1/2 sm:w-full">
                Finished
            </x-tab-option>
            <x-tab-option wire:click.prevent="setState('hiatus')"
                :active="$state == 'hiatus'" class="w-1/2 sm:w-full">
                Hiatus
            </x-tab-option>
            <x-tab-option wire:click.prevent="setState('discontinued')"
                :active="$state == 'discontinued'" class="w-1/2 sm:w-full">
                Discontinued
            </x-tab-option>
        </div>
        @livewire('work.list-works', ['author' => $author->id, 'state' => $state], key('list-works'))
    </div>
</div>
