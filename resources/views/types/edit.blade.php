<x-app-layout>
    <div>
        <form action="{{ route('types.update', $type->id) }}" method="POST">
            @csrf
            @method("PUT")
            <div>
                <label for="name">Nombre</label>
                <div>
                    <input type="text" name="type" id="name" required
                        autocomplete="name" autofocus value="{{ $type->name }}">
                </div>
            </div>

            <div>
                <label for="description">Descripción</label>
                <div>
                    <input type="text" name="description" id="description"
                        required autocomplete="description" value="{{ $type->description }}">
                </div>
            </div>

            <button type="submit">
                Envíar
            </button>
        </form>
    </div>
</x-app-layout>
