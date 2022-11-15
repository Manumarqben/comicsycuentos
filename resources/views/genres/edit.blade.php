<x-app-layout>
    <div>
        <form action="{{ route('genres.update', $genre->id) }}" method="POST">
            @csrf
            @method("PUT")
            <div>
                <label for="name">Nombre</label>
                <div>
                    <input type="text" name="name" id="name" required
                        autocomplete="name" autofocus value="{{ $genre->name }}">
                </div>
            </div>

            <div>
                <label for="description">Descripción</label>
                <div>
                    <input type="text" name="description" id="description"
                        required autocomplete="description" value="{{ $genre->description }}">
                </div>
            </div>

            <button type="submit">
                Envíar
            </button>
        </form>
    </div>
</x-app-layout>
