<x-app-layout>
  <div>
    <form action="{{ route('networks.store') }}" method="post">
      @csrf
      <div>
        <label for="type">Nombre</label>
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