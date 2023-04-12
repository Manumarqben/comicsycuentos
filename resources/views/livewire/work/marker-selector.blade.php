<div class="w-full">
    <select id="selectMarkerSelector" wire:model="marker" class="w-full">
        <option value="">{{ __('Leave') }}</option>
        @foreach ($markers as $marker)
            <option value="{{ $marker->slug }}">{{ $marker->name }}</option>
        @endforeach
    </select>
</div>
