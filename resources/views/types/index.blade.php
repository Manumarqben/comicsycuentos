<x-app-layout>
    <div class="w-full">
        <div class="flex justify-center">
            <div>
                <a href="{{ route('types.create') }}">Crear</a>

                @if ($types->count() > 0)
                    <table>
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($types as $type) 
                                <tr>
                                    <td> <a href="{{ route('types.show', $type->id) }}">{{ $type->name }}</a></td>
                                    <td>{{ $type->description }}</td>
                                    <td>
                                        <a href="{{ route('types.edit', $type->id) }}">Editar</a>
                                        <form
                                            action="{{ route('types.destroy', $type->id) }}"
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
