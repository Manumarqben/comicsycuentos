<div class="container">
    <x-slot name="header">
        <h2 class="h2 text-center">
            {{ "$chapter->number. $chapter->title" }}
        </h2>
    </x-slot>
    <div class="flex justify-between">
        {{-- cabecera del capítulo --}}
        <a href="{{ route('work.show', ['slug' => $chapter->work->slug]) }}"
            class="button">
            {{ __('Back to work') }}
        </a>
        @if ($chapter->type == 'image')
            <x-button wire:click.prevent="">Cascada</x-button>
        @endif
    </div>
    <div>
        {{-- contenido del capítulo --}}
        @if ($chapter->type == 'text')
            @livewire('chapter.reader-text', ['chapterId' => $chapter->id, 'text' => $chapter->text->content])
        @endif

        @if ($chapter->type == 'image')
            @foreach ($chapter->images as $image)
                <div class="flex justify-center pb-1">
                    <img src="{{ asset(Storage::url($image->url)) }}"
                        alt="{{ $image->order }}">
                </div>
            @endforeach
        @endif
    </div>
    <div>
        {{-- pie del capítulo --}}
        @auth
            <div class="w-full flex justify-center">
                @livewire('chapter.like-button', ['chapter' => $chapter], key('like-button'))
            </div>
        @endauth
    </div>
</div>
