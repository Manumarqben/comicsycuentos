<div class="container">
    <div id="carousel" x-data="carousel">
        <div class="relative w-full flex overflow-hidden shadow-2xl">
            <div
                class="rounded-full bg-gray-600 text-white absolute top-5 right-5 text-sm px-2 text-center z-10">
                <span x-text="currentIndex"></span>/
                <span>{{ $worksInCarousel->count() }}</span>
            </div>

            @foreach ($worksInCarousel as $work)
                <div class="h-96"
                    x-show="currentIndex == {{ $loop->iteration }}">
                    <div>
                        <img src="{{ asset(Storage::url($work->front_page)) }}"
                            alt="carousel-{{ $work->slug }}" class="" />
                    </div>
                    <div>
                        
                    </div>
                </div>
            @endforeach

            <div
                class="absolute top-0 left-0 h-full w-1/5 transition-opacity duration-1000 opacity-5 hover:opacity-80 bg-gray-400 dark:bg-gray-600 rounded-r-lg z-20">
                <button @click="back" wire:loading.attr="disabled"
                    class="flex flex-col justify-around items-center w-full h-full"
                    title="{{ __('Previous') }}">
                    <x-icon.chevron-double-left />
                </button>
            </div>
            <div
                class="absolute top-0 right-0 h-full w-1/5 transition-opacity duration-1000 opacity-5 hover:opacity-80 bg-gray-400 dark:bg-gray-600 rounded-l-lg z-20">
                <button @click="next" wire:loading.attr="disabled"
                    class="flex flex-col justify-around items-center w-full h-full"
                    title="{{ __('Next') }}">
                    <x-icon.chevron-double-right />
                </button>
            </div>

            <div class="absolute bottom-0 ">
hola
            </div>
        </div>

        <script>
            function carousel() {
                return {
                    length: @js($worksInCarousel->count()),
                    currentIndex: 1,
                    interval: '',

                    init() {
                        this.startCarousel()
                    },

                    back() {
                        if (this.currentIndex > 1) {
                            this.currentIndex = this.currentIndex -
                                1;
                        } else {
                            this.currentIndex = this.length
                        }
                    },

                    next() {
                        if (this.currentIndex < this.length) {
                            this.currentIndex = this.currentIndex +
                                1;
                        } else if (this.currentIndex <= this.length) {
                            this.currentIndex = 1
                        }
                    },

                    startCarousel() {
                        let intervalId = setInterval(() => {
                            this.next();
                            console.log(this.interval);
                        }, 10000);

                        this.interval = intervalId;
                    },

                    stopCarousel() {
                        clearInterval(this.interval);
                    },
                }
            }
        </script>
    </div>

    <div class="p-5">
        Ultimos capítulos subidos.
        @foreach ($latestAggregatedWorks as $work)
            <p>
                {{ $work->title }}
            </p>
        @endforeach
    </div>
</div>
