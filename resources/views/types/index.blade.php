<x-app-layout>
    <div class="w-full">
        <div class="flex justify-center">
            <div>
                @livewire('componentes.btn-crud', [
                    'recurso' => 'types',
                    'accion' => 'create',
                    'color' => 'green',
                    'slot' => 'Crear',
                ])
                @livewire('componentes.table', [
                    'elementos' => $types,
                    'recurso' => 'types',
                ])
            </div>
        </div>
    </div>
</x-app-layout>
