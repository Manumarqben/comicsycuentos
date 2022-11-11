<div>
    @if ($elementos->count() > 0)
        <table>
            <thead>
                <tr>
                    @foreach (collect($elementos[0])->keys() as $columnas)
                        <th>{{ strtoupper($columnas) }}</th>
                    @endforeach
                    @if ($acciones)
                        <th>ACCIONES</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($elementos as $elemento)
                    <tr>
                        @foreach (collect($elemento) as $valor)
                            <td>
                                {{ $valor }}
                            </td>
                        @endforeach
                        @if ($acciones)
                            <td>
                                @livewire('componentes.btn-crud', [
                                    'recurso' => $recurso,
                                    'accion' => 'edit',
                                    'parametros' => $elemento->id,
                                    'color' => 'yellow',
                                    'slot' => 'Editar',
                                ])
                                @livewire('componentes.btn-crud', [
                                    'recurso' => $recurso,
                                    'accion' => 'destroy',
                                    'parametros' => $elemento->id,
                                    'color' => 'red',
                                    'slot' => 'Borrar',
                                ])
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <h1>No se ha encontrado ningún resultado</h1>
    @endif
</div>
