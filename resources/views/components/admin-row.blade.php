<div {{ $attributes->merge(['class' => 'flex flex-col sm:flex-row justify-center hover:drop-shadow-xl p-3']) }}>
    <div class="flex items-center justify-center sm:justify-start w-full">
        {{ $slot }}
    </div>
    @if (isset($actions))
        <div class="flex flex-row justify-center">
            {{ $actions }}
        </div>
    @endif
</div>
