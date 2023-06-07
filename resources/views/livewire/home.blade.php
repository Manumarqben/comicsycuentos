<div class="container">
    <div id="carousel" x-data="carousel"
        class="w-full flex justify-center px-4 sm:p-0">
        <div
            class="flex flex-col overflow-hidden max-w-5xl w-full rounded-lg shadow-md dark:shadow-gray-600 bg-gray-200 dark:bg-gray-800">
            <div class="flex flex-row">
                @foreach ($worksInCarousel as $work)
                    <div class="relative flex flex-row gap-3 w-full h-96 md:h-[450px] transe"
                        x-show="currentIndex == {{ $loop->iteration }}"
                        x-transition:enter="transition ease-out duration-500"
                        x-transition:enter-start="opacity-0 translate-x-96"
                        x-transition:enter-end="opacity-100 translate-x-0">
                        <div id="image-{{ $work->slug }}"
                            class="w-full sm:w-5/12 md:w-4/12 overflow-hidden sm:border-r-2 cursor-pointer"
                            wire:click="redirectToWork('{{ $work->slug }}')">
                            <img src="{{ asset(Storage::url($work->front_page)) }}"
                                alt="carousel-{{ $work->slug }}"
                                class="object-cover w-full h-full" />
                        </div>
                        <div
                            class="hidden sm:block sm:w-7/12 md:w-8/12 grow space-y-2 p-2">
                            <div id="title"
                                class="text-2xl sm:text-3xl text-center sm:text-left line-clamp-1">
                                {{ $work->title }}
                            </div>
                            <div id="synopsis"
                                class="line-clamp-[12] md:line-clamp-[13]">
                                <div class="text-justify">
                                    {{ $work->synopsis }}
                                </div>
                            </div>
                            <div class="rounded-full bg-gray-600 text-white absolute bottom-2 right-5 -translate-y-1/2 text-sm px-2 text-center z-20 cursor-pointer"
                                wire:click="redirectToWork('{{ $work->slug }}')">
                                <span>{{ __('See work') }}...</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="relative w-full bg-gray-500 bg-opacity-50 border-t-2">
                <div
                    class="flex flex-row justify-center items-center gap-7 h-10">
                    <button @click="back" title="{{ __('Previous') }}">
                        <x-icon.chevron-double-left />
                    </button>
                    <div x-show="playCarousel" class="flex justify-center">
                        <button @click="stopCarousel">
                            <x-icon.pause />
                        </button>
                    </div>
                    <div x-show="!playCarousel" class="flex justify-center">
                        <button @click="startCarousel">
                            <x-icon.play />
                        </button>
                    </div>
                    <button @click="next" title="{{ __('Next') }}">
                        <x-icon.chevron-double-right />
                    </button>
                </div>
                <div
                    class="rounded-full bg-gray-600 text-white absolute top-1/2 right-5 -translate-y-1/2 text-sm px-2 text-center z-10">
                    <span x-text="currentIndex"></span>/
                    <span>{{ $worksInCarousel->count() }}</span>
                </div>
            </div>
        </div>

        <script>
            function carousel() {
                return {
                    playCarousel: false,
                    length: @js($worksInCarousel->count()),
                    currentIndex: 1,
                    interval: '',

                    init() {
                        this.startCarousel()
                    },

                    startCarousel() {
                        let intervalId = setInterval(() => {
                            this.next();
                        }, 10000);

                        this.interval = intervalId;
                        this.playCarousel = true;
                    },

                    stopCarousel() {
                        clearInterval(this.interval);
                        this.playCarousel = false;
                    },

                    resetInterval() {
                        this.stopCarousel();
                        this.startCarousel();
                    },

                    back() {
                        if (this.currentIndex > 1) {
                            this.currentIndex = this.currentIndex - 1;
                        } else {
                            this.currentIndex = this.length
                        }
                        this.resetInterval();
                    },

                    next() {
                        if (this.currentIndex < this.length) {
                            this.currentIndex = this.currentIndex +
                                1;
                        } else if (this.currentIndex <= this.length) {
                            this.currentIndex = 1
                        }
                        this.resetInterval();
                    },
                }
            }
        </script>
    </div>

    <div class="p-8 sm:px-0">
        <div class="border-t border-gray-200 dark:border-gray-700"></div>
    </div>

    <div>
        <div class="text-center pb-5">
            <span class="font-semibold text-4xl text-gray-800 dark:text-gray-200 leading-tight">{{ __('Latest added works') }}</span>
        </div>
        <div
            class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-5 px-2 sm:px-0">
            @forelse ($latestAggregatedWorks as $work)
                @livewire('work.card', ['work' => $work], key($work->slug))
            @empty
                <div class="col-span-full flex justify-center">
                    <p class="h2 pt-5">
                        {{ __('There are no works.') }}
                    </p>
                </div>
            @endforelse
        </div>
    </div>
</div>
