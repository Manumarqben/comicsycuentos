<div class="w-full">
    <select id="selectMarkerSelector" wire:model="marker" class="w-full h-full bg-gray-50 focus:border-gray-50 focus:ring-0 text-gray-900 block border-0">
        <option value="">{{ __('Leave') }}</option>
        @foreach ($markers as $marker)
            <option value="{{ $marker->slug }}">{{ $marker->name }}</option>
        @endforeach
    </select>
</div>
