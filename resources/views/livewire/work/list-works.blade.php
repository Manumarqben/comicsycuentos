<div>
    @forelse ($works as $work)
        <p>{{ $work->title }}</p>
    @empty
        <div class="flex justify-center h2">
            {{ __('There are no works.') }}
        </div>
    @endforelse
    {{ $works->links('livewire.paginator') }}
</div>
