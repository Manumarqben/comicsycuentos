<div>
    @if ($view == 'paginate')
        <div x-data="paginate" class="relative">
            <div class="absolute top-0 left-0 h-full w-1/5 transition-opacity duration-1000 opacity-5 hover:opacity-80 bg-gray-600 dark:bg-gray-800 rounded-l-lg navPage"
                wire:click="prevPage">
                prev
            </div>
            <div class="flex justify-center md:p-2 pb-1 w-full">
                <img src="{{ asset(Storage::url($imagesList->url)) }}"
                    alt="{{ $imagesList->order }}" class="w-full rounded-md">
            </div>
            <div class="absolute top-0 right-0 h-full w-1/5 transition-opacity duration-1000 opacity-5 hover:opacity-80 bg-gray-600 dark:bg-gray-800 rounded-l-lg navPage"
                wire:click="nextPage">
                next
            </div>
        </div>
    @endif
    @if ($view == 'cascade')
        @foreach ($imagesList as $image)
            <div class="md:p-2 pb-1 w-full">
                <img src="{{ asset(Storage::url($image->url)) }}"
                    alt="{{ $image->order }}" class="w-full rounded-md">
            </div>
        @endforeach
    @endif

    <script>
        function paginate() {
            return {
                navPageTransition: @entangle('navPageTransition').defer,
                page: @entangle('page'),

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
