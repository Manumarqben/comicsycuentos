<x-app-layout>
    <div class="w-full">
        <div class="flex justify-center">
            <div>
                <a href="{{ route('ages.create') }}">Crear</a>

                @if ($ages->count() > 0)
                    <table>
                        <thead>
                            <tr>
                                <th>Edad</th>
                                <th>Descripción</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ages as $age)
                                <tr>
                                    <td>
                                        <a href="{{ route('ages.show', $age->id) }}">
                                            {{ $age->age }}
                                        </a>
                                    </td>
                                    <td>{{ $age->description }}</td>
                                    <td>
                                        <a href="{{ route('ages.edit', $age->id) }}">Editar</a>
                                        <form
                                            action="{{ route('ages.destroy', $age->id) }}"
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
