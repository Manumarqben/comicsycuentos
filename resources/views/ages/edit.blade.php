<x-app-layout>
    <div>
        <form action="{{ route('ages.update', $age->id) }}" method="POST">
            @csrf
            @method("PUT")
            <div>
                <label for="age">Edad</label>
                <div>
                    <input type="number" name="age" id="age" required
                        autocomplete="age" autofocus value="{{ $age->age }}">
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
