<x-app-layout>
    <div>
        <form action="{{ route('networks.update', $network->id) }}" method="post">
            @csrf
            @method("put")
            <div>
                <label for="name">Nombre</label>
                <div>
                    <input type="text" name="type" id="name" required
                        autocomplete="name" autofocus value="{{ $network->name }}">
                </div>
            </div>

            <button type="submit">
                Envíar
            </button>
        </form>
    </div>
</x-app-layout>
