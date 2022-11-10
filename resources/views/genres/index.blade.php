<x-app-layout>
    <div class="w-full">
        <div class="flex justify-center">
            <div>
                <a href="{{ route('genres.create') }}">Crear</a>

                @if ($genres->count() > 0)
                    <table>
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($genres as $genre) 
                                <tr>
                                    <td> <a href="{{ route('genres.show', $genre->id) }}">{{ $genre->name }}</a></td>
                                    <td>{{ $genre->description }}</td>
                                    <td>
                                        <a href="{{ route('genres.edit', $genre->id) }}">Editar</a>
                                        <form
                                            action="{{ route('genres.destroy', $genre->id) }}"
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
