<x-app-layout>
  <div>
    <form action="{{ route('states.store') }}" method="POST">
      @csrf
      <div>
        <label for="name">Nombre</label>
        <div>
          <input type="text" name="name" id="name" required autocomplete="name" autofocus>
        </div>
      </div>

      <button type="submit">
        Envíar
      </button>
    </form>
  </div>
</x-app-layout>