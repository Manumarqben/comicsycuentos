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
    <div class="flex flex-row px-4">
        {{-- pie del capítulo --}}
        <div class="w-full felx justify-start">
            @if ($chapter->hasPreviousChapter())
                <a href="{{ route('chapter.viewer', ['workSlug' => $chapter->work->slug, 'chapterNumber' => $chapter->number - 1]) }}"
                    class="button">
                    <x-icon.chevron-double-left type="mini" />
                    <span class="hidden sm:block pl-1">
                        {{ __('Prev') }}
                    </span>
                </a>
            @endif
        </div>
        <div class="w-full flex justify-center">
            @auth
                @livewire('chapter.like-button', ['chapter' => $chapter], key('like-button'))
            @endauth
        </div>
        <div class="w-full flex justify-end">
            @if ($chapter->hasNextChapter())
                <a href="{{ route('chapter.viewer', ['workSlug' => $chapter->work->slug, 'chapterNumber' => $chapter->number + 1]) }}"
                    class="button">
                    <span class="hidden sm:block pr-1">
                        {{ __('Next') }}
                    </span>
                    <x-icon.chevron-double-right type="mini" />
                </a>
            @endif
        </div>
    </div>
</div>
