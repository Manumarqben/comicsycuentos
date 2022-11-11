<x-app-layout>
    <div class="w-full">
        <div class="flex justify-center">
            <div>
                @livewire('componentes.btn-crud', [
                    'recurso' => 'genres',
                    'accion' => 'create',
                    'color' => 'green',
                    'slot' => 'Crear',
                ])
                @livewire('componentes.table', [
                    'elementos' => $genres,
                    'recurso' => 'genres',
                ])
            </div>
        </div>
</x-app-layout>
