<h1>New chapter of {{ $title }}</h1>
<p>
    If you want to read it click
    <a
        href="{{ route('chapter.viewer', ['workSlug' => $slug, 'chapterNumber' => $number]) }}">
        here
    </a>
</p>
