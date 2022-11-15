<x-app-layout>
    <div>
        <form action="{{ route('ages.update', $age->id) }}" method="POST">
            @csrf
            @method("PUT")
            <div>
                <label for="name">Edad</label>
                <div>
                    <input type="number" name="name" id="name" required
                        autocomplete="name" autofocus value="{{ $age->name }}">
                </div>
            </div>

            <div>
                <label for="description">Descripción</label>
                <div>
                    <input type="text" name="description" id="description"
                        required autocomplete="description" value="{{ $age->description }}">
                </div>
            </div>

            <button type="submit">
                Envíar
            </button>
        </form>
    </div>
</x-app-layout>
