<div>
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-2">
        @forelse ($works as $work)
            @livewire('work.card', ['work' => $work], key($work->slug))
        @empty
            <div class="col-span-full flex justify-center">
                <p class="h2 pt-5">
                    {{ __('There are no works.') }}
                </p>
            </div>
        @endforelse
    </div>
    {{ $works->links('livewire.paginator') }}
</div>
