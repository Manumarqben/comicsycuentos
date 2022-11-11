<x-app-layout>
    <div class="w-full">
        <div class="flex justify-center">
            <div>
                @livewire('componentes.btn-crud', [
                    'recurso' => 'works',
                    'accion' => 'create',
                    'color' => 'green',
                    'slot' => 'Crear',
                ])
                @livewire('componentes.table', [
                    'elementos' => $works,
                    'recurso' => 'works',
                ])
            </div>
        </div>
    </div>
</x-app-layout>
