<x-app-layout>
    <div class="w-full">
        <div class="flex justify-center">
            <div>
                @livewire('componentes.btn-crud', [
                    'recurso' => 'authors',
                    'accion' => 'create',
                    'color' => 'green',
                    'slot' => 'Crear',
                ])
                @livewire('componentes.table', [
                    'elementos' => $authors,
                    'recurso' => 'authors',
                ])
            </div>
        </div>
    </div>
</x-app-layout>
