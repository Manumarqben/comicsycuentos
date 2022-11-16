<x-app-layout>
    <div>
        <form action="{{ route('authors.update', $author->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div>
                <label for="alias">Alias</label>
                <div>
                    <input type="text" name="alias" id="alias" required
                        autocomplete="alias" autofocus
                        value="{{ $author->alias }}">
                </div>
            </div>
            <div>
                <label for="biography">Biografía</label>
                <div>
                    <input type="text" name="biography" id="biography"
                        autocomplete="biography"
                        value="{{ $author->biography }}">
                </div>
            </div>

            <div>
                <label for="profile_photo_path">Protada</label>
                <div>
                    <input type="file" name="profile_photo_path"
                        id="profile_photo_path">
                </div>
            </div>

            <button type="submit">
                Envíar
            </button>
        </form>
    </div>
</x-app-layout>
