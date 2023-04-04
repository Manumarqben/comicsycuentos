<div>
    @forelse ($works as $work)
        <div>
            <a href="{{ route('work.show', $work->slug) }}">
                {{ $work->title }}
            </a>
        </div>
    @empty
        <div class="flex justify-center h2">
            {{ __('There are no works.') }}
        </div>
    @endforelse
    {{ $works->links('livewire.paginator') }}
</div>
