@extends('layouts.admin')

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0" style="color: #e85d1f;">Turnos</h1>
        <a href="{{ route('admin.turnos.create') }}" class="btn btn-naranja">
            <i class="bi bi-plus-circle"></i> Nuevo Turno
        </a>
    </div>

    <h4 class="mb-2">Turnos para el día de hoy</h4>
    <div class="card shadow-sm categorias-card mb-4">
        <div class="card-body p-0">
            <table class="table categorias-table mb-0">
                <thead class="categorias-thead">
                    <tr>
                        <th>Usuario</th>
                        <th>Hora Inicio</th>
                        <th>Hora Fin</th>
                        <th>Notas</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($turnosHoy as $turno)
                        <tr class="{{ $loop->even ? 'fila-naranja-clara' : 'fila-blanca' }}">
                            <td>{{ $turno->usuario->nombre ?? 'N/A' }}</td>
                            <td>{{ $turno->hora_inicio }}</td>
                            <td>{{ $turno->hora_fin }}</td>
                            <td>{{ $turno->notas ?? '-' }}</td>
                            <td class="text-end">
                                <a href="{{ route('admin.turnos.show', $turno) }}" class="btn btn-sm btn-info text-white">Ver</a>
                                <a href="{{ route('admin.turnos.edit', $turno) }}" class="btn btn-sm btn-warning">Editar</a>
                                <form method="POST" action="{{ route('admin.turnos.destroy', $turno) }}" style="display:inline-block" onsubmit="return confirm('¿Seguro que deseas eliminar este turno?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No hay turnos para hoy.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <h4 class="mb-2">Turnos anteriores</h4>
    <div class="card shadow-sm categorias-card">
        <div class="card-body p-0">
            <table class="table categorias-table mb-0">
                <thead class="categorias-thead">
                    <tr>
                        <th>Usuario</th>
                        <th>Fecha</th>
                        <th>Hora Inicio</th>
                        <th>Hora Fin</th>
                        <th>Notas</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($turnosAnteriores as $turno)
                        <tr class="{{ $loop->even ? 'fila-naranja-clara' : 'fila-blanca' }}">
                            <td>{{ $turno->usuario->nombre ?? 'N/A' }}</td>
                            <td>{{ \Carbon\Carbon::parse($turno->created_at)->format('d/m/Y') }}</td>
                            <td>{{ $turno->hora_inicio }}</td>
                            <td>{{ $turno->hora_fin }}</td>
                            <td>{{ $turno->notas ?? '-' }}</td>
                            <td class="text-end">
                                <a href="{{ route('admin.turnos.show', $turno) }}" class="btn btn-sm btn-info text-white">Ver</a>
                                <a href="{{ route('admin.turnos.edit', $turno) }}" class="btn btn-sm btn-warning">Editar</a>
                                <form method="POST" action="{{ route('admin.turnos.destroy', $turno) }}" style="display:inline-block" onsubmit="return confirm('¿Seguro que deseas eliminar este turno?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No hay turnos anteriores.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $turnosAnteriores->links() }}
    </div>
@endsection
