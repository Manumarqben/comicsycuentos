<div>
    @if ($elementos->count() > 0)
        <table>
            <thead>
                <tr>
                    @foreach (collect($elementos[0])->keys() as $columnas)
                        <th>{{ strtoupper($columnas) }}</th>
                    @endforeach
                    @if ($acciones)
                        <th>Acciones</th>
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
                                <a href="{{ route($ruta . '.edit', $elemento->id) }}"
                                    class="inline-flex items-center justify-center px-4 py-2 bg-yellow-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-500 focus:outline-none focus:border-yellow-700 focus:ring focus:ring-yellow-200 active:bg-yellow-600 disabled:opacity-25 transition">Editar</a>
                                <form
                                    action="{{ route($ruta . '.destroy', $elemento->id) }}"
                                    method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit"
                                        class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-200 active:bg-red-600 disabled:opacity-25 transition">
                                        Borrar
                                    </button>
                                </form>
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
