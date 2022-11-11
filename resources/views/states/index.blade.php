<x-app-layout>
    <div class="w-full">
        <div class="flex justify-center">
            <div>
                @livewire('componentes.btn-crud', [
                    'recurso' => 'states',
                    'accion' => 'create',
                    'color' => 'green',
                    'slot' => 'Crear',
                ])
                @livewire('componentes.table', [
                    'elementos' => $states,
                    'recurso' => 'states',
                ])
            </div>
        </div>
    </div>
</x-app-layout>
