<x-app-layout>
    <div>
        <form action="{{ route('states.update', $state->id) }}"
            method="POST">
            @csrf
            @method('PUT')
            <div>
                <label for="name">Nombre</label>
                <div>
                    <input type="text" name="name" id="name" required
                        autocomplete="name" autofocus
                        value="{{ $state->name }}"
                    >
                </div>
            </div>

            <button type="submit">
                Envíar
            </button>
        </form>
    </div>
</x-app-layout>
