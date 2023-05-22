<div class="container">
    @if ($chapter->type == 'text')
        @livewire('chapter.reader-text', ['chapterId' => $chapter->id,'text' => $chapter->text->content])
    @endif

    @if ($chapter->type == 'image')
        @foreach ($chapter->images as $image)
            <div class="flex justify-center pb-1">
                <img src="{{ asset(Storage::url($image->url)) }}"
                    alt="{{ $image->order }}">
            </div>
        @endforeach
    @endif
    @auth
        <div class="w-full flex justify-center">
            @livewire('chapter.like-button', ['chapter' => $chapter], key('like-button'))
        </div>
    @endauth
</div>
