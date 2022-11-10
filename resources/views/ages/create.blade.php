<x-app-layout>
  <div>
    <form action="{{ route('ages.store') }}" method="POST">
      @csrf
      <div>
        <label for="age">Edad</label>
        <div>
          <input type="number" name="age" id="age" required autocomplete="age" autofocus>
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