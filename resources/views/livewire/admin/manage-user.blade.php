<div>
    <x-slot name="header">
        <h2 class="h2">
            {{ __('User administration panel') }}
        </h2>
    </x-slot>
    <div class="container">
        <div class="mt-10 sm:mt-0">
            @livewire('admin.manage-user-information-form', ['user' => $user])
        </div>

        <x-section-border />

        <div class="mt-10 sm:mt-0">
            {{-- TODO: baneos --}}
        </div>
    </div>
</div>
