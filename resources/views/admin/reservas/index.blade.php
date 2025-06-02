@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="mb-0" style="color: #e85d1f;">Reservas</h1>
    <a href="{{ route('admin.reservas.create') }}" class="btn btn-naranja">
        <i class="bi bi-plus-circle"></i> Nueva Reserva
    </a>
</div>

{{-- Reservas de hoy próximas a vencer --}}
@if($reservasHoy->count())
    <div class="mb-4">
        <h4 class="mb-2">Próximas a vencer (Hoy)</h4>
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Usuario</th>
                        <th>Mesa</th>
                        <th>Hora inicio</th>
                        <th>Hora fin</th>
                        <th>Comensales</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($reservasHoy as $reserva)
                    <tr>
                        <td>{{ $reserva->usuario->nombre ?? '-' }}</td>
                        <td>{{ $reserva->mesa->numero ?? '-' }}</td>
                        <td>{{ $reserva->hora_reservacion }}</td>
                        <td>{{ $reserva->hora_fin ?? '-' }}</td>
                        <td>{{ $reserva->numero_comensales }}</td>
                        <td>
                            <span class="badge bg-{{ $reserva->estado == 'confirmada' ? 'success' : ($reserva->estado == 'pendiente' ? 'warning' : 'danger') }}">
                                {{ ucfirst($reserva->estado) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.reservas.show', $reserva) }}" class="btn btn-sm btn-info">Ver</a>
                            <a href="{{ route('admin.reservas.edit', $reserva) }}" class="btn btn-sm btn-warning">Editar</a>
                            <form action="{{ route('admin.reservas.destroy', $reserva) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar esta reserva?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" type="submit">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endif

{{-- Reservas de hoy vencidas --}}
@if($reservasVencidas->count())
    <div class="mb-4">
        <h4 class="text-secondary">Vencidas (Hoy)</h4>
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Usuario</th>
                        <th>Mesa</th>
                        <th>Hora inicio</th>
                        <th>Hora fin</th>
                        <th>Comensales</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($reservasVencidas as $reserva)
                    <tr>
                        <td>{{ $reserva->usuario->nombre ?? '-' }}</td>
                        <td>{{ $reserva->mesa->numero ?? '-' }}</td>
                        <td>{{ $reserva->hora_reservacion }}</td>
                        <td>{{ $reserva->hora_fin ?? '-' }}</td>
                        <td>{{ $reserva->numero_comensales }}</td>
                        <td>
                            <span class="badge bg-{{ $reserva->estado == 'confirmada' ? 'success' : ($reserva->estado == 'pendiente' ? 'warning' : 'danger') }}">
                                {{ ucfirst($reserva->estado) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.reservas.show', $reserva) }}" class="btn btn-sm btn-info">Ver</a>
                            <a href="{{ route('admin.reservas.edit', $reserva) }}" class="btn btn-sm btn-warning">Editar</a>
                            <form action="{{ route('admin.reservas.destroy', $reserva) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar esta reserva?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" type="submit">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endif

{{-- Reservas pasadas --}}
@if($reservasPasadas->count())
    <div class="mb-4">
        <h4 class="mb-2">Reservas Pasadas</h4>
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Usuario</th>
                        <th>Mesa</th>
                        <th>Fecha</th>
                        <th>Hora inicio</th>
                        <th>Hora fin</th>
                        <th>Comensales</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($reservasPasadas as $reserva)
                    <tr>
                        <td>{{ $reserva->usuario->nombre ?? '-' }}</td>
                        <td>{{ $reserva->mesa->numero ?? '-' }}</td>
                        <td>{{ \Carbon\Carbon::parse($reserva->fecha_reservacion)->format('d/m/Y') }}</td>
                        <td>{{ $reserva->hora_reservacion }}</td>
                        <td>{{ $reserva->hora_fin ?? '-' }}</td>
                        <td>{{ $reserva->numero_comensales }}</td>
                        <td>
                            <span class="badge bg-{{ $reserva->estado == 'confirmada' ? 'success' : ($reserva->estado == 'pendiente' ? 'warning' : 'danger') }}">
                                {{ ucfirst($reserva->estado) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.reservas.show', $reserva) }}" class="btn btn-sm btn-info">Ver</a>
                            <a href="{{ route('admin.reservas.edit', $reserva) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i> Editar</a>
                            <form action="{{ route('admin.reservas.destroy', $reserva) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar esta reserva?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" type="submit"><i class="bi bi-trash"></i> Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endif

@if(!$reservasHoy->count() && !$reservasVencidas->count() && !$reservasPasadas->count())
    <div class="alert alert-info">
        No hay reservas registradas.
    </div>
@endif
@endsection
