<div>
    @if ($view == 'paginate')
        <div x-data="paginate" class="relative w-full">
            <div
                class="absolute top-0 left-0 h-full w-1/5 transition-opacity duration-1000 opacity-5 hover:opacity-80 bg-gray-600 dark:bg-gray-800 rounded-r-lg navPage {{ $page <= 1 ? 'hidden' : '' }}">
                <button wire:click.prevent="prevPage" wire:loading.attr="disabled"
                    class="w-full h-full">
                    prev
                </button>
            </div>
            <div id="paginated-image"
                class="flex justify-center items-center sm:p-2 pb-1 w-full">
                <img src="{{ asset(Storage::url($imagesList->url)) }}"
                    alt="{{ $imagesList->order }}"
                    class="w-full max-w-3xl rounded-md">
            </div>
            <div
                class="absolute top-0 right-0 h-full w-1/5 transition-opacity duration-1000 opacity-5 hover:opacity-80 bg-gray-600 dark:bg-gray-800 rounded-l-lg navPage {{ $page >= $images->count() ? 'hidden' : '' }}">
                <button wire:click.prevent="nextPage"
                    wire:loading.attr="disabled" class="w-full h-full">
                    next
                </button>
            </div>
        </div>
    @endif
    @if ($view == 'cascade')
        <div class="flex flex-col items-center sm:p-2 w-full">
            @foreach ($imagesList as $image)
                <img src="{{ asset(Storage::url($image->url)) }}"
                    alt="{{ $image->order }}"
                    class="pb-1 w-full max-w-3xl rounded-md">
            @endforeach
        </div>
    @endif

    <script>
        function paginate() {
            return {
                navPageTransition: @entangle('navPageTransition').defer,
                page: @entangle('page'),
                view: @entangle('view'),

                init() {
                    if (this.navPageTransition) {
                        let navPages = document.querySelectorAll('.navPage');
                        navPages.forEach(element => {
                            element.classList.remove('opacity-5');
                            element.classList.add('opacity-80');

                            setTimeout(() => {
                                element.classList.remove(
                                    'opacity-80');
                                element.classList.add('opacity-5');
                            }, 2000);
                            this.navPageTransition = false
                        });
                    };

                    this.$watch('page', value => {
                        if (this.view == 'paginate') {
                            let image = document.querySelector(
                                '#paginated-image');
                            image.classList.add('opacity-0');
                            setTimeout(() => {
                                image.classList.remove('opacity-0');
                            }, 1000);
                        }

                        window.scroll({
                            top: 0,
                            behavior: 'instant',
                        })
                    })
                },
            }
        }
    </script>
</div>
