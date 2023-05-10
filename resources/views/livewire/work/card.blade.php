<div class="relative cursor-pointer h-full w-full" wire:click="redirectToWork">
    <div id="title" class="absolute top-0 h-1/6 w-full">
        <div
            class="flex justify-center items-center h-full bg-white bg-opacity-90 px-3">
            <p class="sm:text-xl font-bold text-gray-800 line-clamp-1">
                {{ $work->title }}
            </p>
        </div>
    </div>
    <div id="frontPage" class="h-full w-full">
        <img class="object-cover w-full h-full"
            src="{{ asset(Storage::url($work->front_page)) }}"
            alt="{{ $work->slug . 'frontpage' }}" />
    </div>
</div>
