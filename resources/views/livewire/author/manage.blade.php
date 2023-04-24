<div>
    <x-slot name="header">
        <h2 class="h2">
            {{ __('Author administration panel') }}
        </h2>
    </x-slot>
    <div class="container">
        <div class="mt-10 sm:mt-0">
            @livewire('author.update-author-information-form', ['author' => $author])
        </div>

        <x-section-border />

        <div class="mt-10 sm:mt-0">
            <x-action-section>
                <x-slot name="title">
                    {{ __('Works list') }}
                </x-slot>
                <x-slot name="description">
                    {{ __('List of works to manage.') }}
                </x-slot>
                <x-slot name="content">
                    <div class="flex justify-end">
                        <a href="{{ route('work.create') }}" class="button">
                            {{ __('Create new work') }}
                        </a>
                    </div>
                    @if ($author->works->count() > 0)
                        <div
                            class="w-full flex flex-col max-h-[500px] overflow-y-auto mt-4">
                            @foreach ($author->works as $work)
                                <div
                                    class="flex flex-col sm:flex-row justify-center rounded-lg hover:drop-shadow-xl p-3">
                                    <div
                                        class="flex items-center justify-center sm:justify-start cursor-pointer w-full">
                                        <p class="line-clamp-1">
                                            {{ $work->title }}</p>
                                    </div>
                                    <div class="flex flex-row justify-center">
                                        <a href="{{ route('work.update', $work->slug) }}"
                                            class="button">
                                            <x-icon.edit />
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </x-slot>
            </x-action-section>
        </div>

        <x-section-border />

        <div class="mt-10 sm:mt-0">
            @livewire('author.delete-author-form', ['author' => $author])
        </div>
    </div>
</div>
