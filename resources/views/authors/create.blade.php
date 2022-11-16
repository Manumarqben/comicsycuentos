<x-app-layout>
    <div>
        <form action="{{ route('authors.store') }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <div>
                <label for="alias">Alias</label>
                <div>
                    <input type="text" name="alias" id="alias"
                        autocomplete="alias" autofocus>
                </div>
            </div>
            <div>
                <label for="biography">Biografía</label>
                <div>
                    <input type="text" name="biography" id="biography"
                        autocomplete="biography">
                </div>
            </div>

            <div>
                <label for="profile_photo_path">Perfil</label>
                <div>
                    <input type="file" name="profile_photo_path"
                        id="profile_photo_path">
                </div>
            </div>

            <div>
                <button type="submit">
                    Envíar
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
