@props(['type' => 'Type', 'age' => 'TP', 'frontPage' => '', 'imgAlt' => 'Front Page'])

<div
    {{ $attributes->merge(['class' => 'relative h-80 w-64 sm:h-96 sm:w-72']) }}>
    <div id="type" class="absolute top-0 h-1/6 w-full">
        <div
            class="flex justify-center items-center h-full bg-white bg-opacity-90">
            <p class="text-4xl font-bold text-gray-800">
                {{ $type }}
            </p>
        </div>
    </div>
    <div id="frontPage" class="h-full w-full">
        <img class="object-cover w-full h-full" src="{{ $frontPage }}"
            alt="{{ $imgAlt }}" />
    </div>
    <div id="age" class="absolute bottom-0 right-0 h-1/6 aspect-square">
        <div
            class="flex justify-center items-center h-full bg-white bg-opacity-90">
            <p class="text-2xl sm:text-3xl font-bold text-gray-800">
                {{ $age }}
            </p>
        </div>
    </div>
</div>
