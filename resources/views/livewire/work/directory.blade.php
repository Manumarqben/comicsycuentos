<div>
    <x-slot name="header">
        <h2 class="h2">
            {{ __('Works directory') }}
        </h2>
    </x-slot>
    <div class="container">
        @foreach ($works as $work)
            <a href="{{ route('work.show', $work->slug) }}">
                {{ $work->title }}
            </a>
            <br>
        @endforeach
    </div>
</div>
