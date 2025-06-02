@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0" style="color: #e85d1f;">Mesas</h1>
        <a href="{{ route('admin.mesas.create') }}" class="btn btn-naranja">
            <i class="bi bi-plus-circle"></i> Nueva Mesa
        </a>
    </div>

    <form method="GET" action="{{ route('admin.mesas.index') }}" class="row g-3 mb-4">
        <div class="col-md-4">
            <select name="estado" class="form-select">
                <option value="">Todas las mesas</option>
                <option value="disponible" {{ request('estado') == 'disponible' ? 'selected' : '' }}>Solo disponibles
                </option>
                <option value="ocupada" {{ request('estado') == 'ocupada' ? 'selected' : '' }}>Ocupadas</option>
                <option value="reservada" {{ request('estado') == 'reservada' ? 'selected' : '' }}>Reservadas</option>
                <option value="mantenimiento" {{ request('estado') == 'mantenimiento' ? 'selected' : '' }}>En
                    mantenimiento</option>
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-naranja w-100">Filtrar</button>
        </div>
        <div class="col-md-2">
            <a href="{{ route('admin.mesas.index') }}" class="btn btn-secondary w-100">Limpiar</a>
        </div>
    </form>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm categorias-card">
        <div class="card-body p-0">
            <table class="table categorias-table mb-0">
                <thead class="categorias-thead">
                    <tr>
                        <th>Número</th>
                        <th>Capacidad</th>
                        <th>Estado</th>
                        <th>Ubicación</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($mesas as $mesa)
                    <tr class="{{ $loop->even ? 'fila-naranja-clara' : 'fila-blanca' }}">
                        <td>{{ $mesa->numero }}</td>
                        <td>{{ $mesa->capacidad }}</td>
                        <td>
                            <span class="badge
                                @if($mesa->estado == 'disponible') bg-success
                                @elseif($mesa->estado == 'ocupada') bg-danger
                                @elseif($mesa->estado == 'reservada') bg-warning text-dark
                                @else bg-secondary @endif">
                                {{ ucfirst($mesa->estado) }}
                            </span>
                        </td>
                        <td>{{ $mesa->ubicacion ?? '-' }}</td>
                        <td class="text-end">
                            <a href="{{ route('admin.mesas.show', $mesa) }}" class="btn btn-sm btn-info text-white">Ver</a>
                            <a href="{{ route('admin.mesas.edit', $mesa) }}" class="btn btn-sm btn-warning">Editar</a>
                            <form method="POST" action="{{ route('admin.mesas.destroy', $mesa) }}" style="display:inline-block"
                                onsubmit="return confirm('¿Seguro que deseas eliminar esta mesa?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">No hay mesas registradas.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $mesas->withQueryString()->links() }}
    </div>
@endsection
