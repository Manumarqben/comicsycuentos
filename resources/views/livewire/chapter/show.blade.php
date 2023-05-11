<div class="container">
    @if ($typeContent == 'text')
        <div>
            {!! $chapter->text->content !!}
        </div>
    @endif

    @if ($typeContent == 'images')
        @foreach ($content as $image)
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
