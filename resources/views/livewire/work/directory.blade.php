<div>
    <x-slot name="header">
        <h2 class="h2">
            {{ __('Works directory') }}
        </h2>
    </x-slot>
    <div class="container">
        @livewire('work.list-works', key('list-directory'))
    </div>
</div>
