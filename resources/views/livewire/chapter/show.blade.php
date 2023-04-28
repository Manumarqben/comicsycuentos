<div class="container">
    @if ($typeContent == 'text')
        <div>
            {!! $chapter->text->content !!}
        </div>
    @endif

    @if ($typeContent == 'images')
        @foreach ($content as $image)
            <div class="flex justify-center pb-1">
                <img src="{{ $image->url }}" alt="{{ $image->order }}">
            </div>
        @endforeach
    @endif
</div>
