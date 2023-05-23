<div class="container">
    <x-slot name="header">
        <h2 class="h2 text-center">
            {{ "$chapter->number. $chapter->title" }}
        </h2>
    </x-slot>
    <div class="flex justify-between px-4">
        {{-- cabecera del capítulo --}}
        <a href="{{ route('work.show', ['slug' => $chapter->work->slug]) }}"
            class="button">
            <x-icon.arrow-left type="mini" />
            <span class="hidden sm:block pl-1">{{ __('Back to work') }}</span>
        </a>
        @if ($chapter->type == 'image')
            <x-button wire:click.prevent="">
                <span class="hidden sm:block pr-1">
                    {{ __('Cascade') }}
                </span>
                <x-icon.document-duplicate type="solid" />
            </x-button>
            <x-button wire:click.prevent="">
                <span class="hidden sm:block pr-1">
                    {{ __('Paginate') }}
                </span>
                <x-icon.document type="solid" />
            </x-button>
        @endif
    </div>
    <div class="my-3 py-3 bg-gray-50 dark:bg-gray-800 rounded">
        {{-- contenido del capítulo --}}
        @if ($chapter->type == 'text')
            @livewire('chapter.reader-text', ['chapterId' => $chapter->id, 'text' => $chapter->text->content])
        @endif

        @if ($chapter->type == 'image')
            {{-- @foreach ($chapter->images as $image)
                <div class="flex justify-center pb-1">
                    <img src="{{ asset(Storage::url($image->url)) }}"
                        alt="{{ $image->order }}">
                </div>
            @endforeach --}}
        @endif
    </div>
    <div class="flex justify-between px-4">
        {{-- pie del capítulo --}}
        @auth
            <div class="w-full flex justify-center">
                @livewire('chapter.like-button', ['chapter' => $chapter], key('like-button'))
            </div>
        @endauth
    </div>
</div>
