<x-app-layout>
  <div>
    <form action="{{ route('types.store') }}" method="POST">
      @csrf
      <div>
        <label for="type">Nombre</label>
        <div>
          <input type="text" name="name" id="name" required autocomplete="name" autofocus>
        </div>
      </div>

      <div>
        <label for="description">Descripción</label>
        <div>
          <input type="text" name="description" id="description" required autocomplete="description">
        </div>
      </div>

      <button type="submit">
        Envíar
      </button>
    </form>
  </div>
</x-app-layout>