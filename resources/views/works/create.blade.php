<x-app-layout>
    <div>
        <form action="{{ route('works.store') }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <div>
                <label for="title">Título</label>
                <div>
                    <input type="text" name="title" id="title" required
                        autocomplete="title" autofocus>
                </div>
            </div>
            <div>
                <label for="synopsis">Sinopsis</label>
                <div>
                    <input type="text" name="synopsis" id="synopsis" required
                        autocomplete="synopsis">
                </div>
            </div>

            <div>
                <label for="front_page">Protada</label>
                <div>
                    <input type="file" name="front_page" id="front_page"
                        required>
                </div>
            </div>
            
            <div>
                <select name="age_id" id="age_id">
                    @foreach ($ages as $age)
                        <option value="{{ $age->id }}">
                            {{ $age->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <select name="state_id" id="state_id">
                    @foreach ($states as $state)
                        <option value="{{ $state->id }}">
                            {{ $state->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <select name="type_id" id="type_id">
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}">
                            {{ $type->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>

                <button type="submit">
                    Envíar
                </button>
        </form>
    </div>
</x-app-layout>
