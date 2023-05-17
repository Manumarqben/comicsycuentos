<div>
    <x-slot name="header">
        <h2 class="h2">
            {{ __('Author administration panel') }}
        </h2>
    </x-slot>
    <div class="container">
        <div class="mt-10 sm:mt-0">
            @livewire('admin.manage-author-information-form', ['author' => $author])
        </div>

        <x-section-border />

        <div class="mt-10 sm:mt-0">
            @livewire('admin.manage-author-works', ['author' => $author])
        </div>
    </div>
</div>
