<x-app-layout>
    <div class="w-full">
        <div class="flex justify-center">
            <div>
                @livewire('componentes.a-btn', [
                    'ruta' => 'types.create',
                    'color' => 'green',
                    'slot' => 'Crear',
                ])
                @livewire('componentes.table', [
                    'elementos' => $networks,
                    'ruta' => 'networks',
                ])
            </div>
        </div>
</x-app-layout>
