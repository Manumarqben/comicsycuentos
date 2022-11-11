<div>
    @if (strtoupper($accion) == 'DESTROY')
        <form action="{{ route($ruta, $parametros) }}" method="post">
            @csrf
            @method('delete')
            <button type="submit"
                class="inline-flex items-center justify-center px-4 py-2 bg-{{ $color }}-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-{{ $color }}-500 focus:outline-none focus:border-{{ $color }}-700 focus:ring focus:ring-{{ $color }}-200 active:bg-{{ $color }}-600 disabled:opacity-25 transition">
                {{ $slot }}
            </button>
        </form>
    @else
        <a href="{{ route($ruta, $parametros) }}"
            class="inline-flex items-center justify-center px-4 py-2 bg-{{ $color }}-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-{{ $color }}-500 focus:outline-none focus:border-{{ $color }}-700 focus:ring focus:ring-{{ $color }}-200 active:bg-{{ $color }}-600 disabled:opacity-25 transition">
            {{ $slot }}
        </a>
    @endif
</div>
