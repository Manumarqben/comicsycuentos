<x-app-layout>
    <div class="w-full">
        <div class="flex justify-center">
            <div>
                <a href="{{ route('networks.create') }}">Crear</a>

                @if ($networks->count() > 0)
                    <table>
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($networks as $network) 
                                <tr>
                                    <td> <a href="{{ route('networks.show', $network->id) }}">{{ $network->name }}</a></td>
                                    <td>
                                        <a href="{{ route('types.edit', $network->id) }}">Editar</a>
                                        <form
                                            action="{{ route('types.destroy', $network->id) }}"
                                            method="post">
                                            @csrf
                                            @method('delete')
                                            <button
                                                type="submit">Borrar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif

            </div>
        </div>
</x-app-layout>
