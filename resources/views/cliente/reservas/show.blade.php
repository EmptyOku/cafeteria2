{{-- filepath: f:\cafeteria2\resources\views\cliente\reservas\show.blade.php --}}
@extends('layouts.navigation')

@section('content')
<div class="container mt-5  py-4">
    <h2 class="mt-5 text-center" style="color:#ff7043;">
        <i class="fas fa-chair"></i> Mis Reservas
    </h2>
    <a href="{{ route('cliente.reservas.index') }}" class="btn btn-naranja">volver</a>
    @if($reservas->isEmpty())
        <div class="alert alert-warning text-center">
            No tienes reservas registradas.
        </div>
    @else
    <div class="table-responsive">
        <table class="table table-bordered align-middle shadow-sm">
            <thead style="background-color:#ff7043; color:#fff;">
                <tr>
                    <th>Mesa</th>
                    <th>Fecha</th>
                    <th>Hora inicio</th>
                    <th>Hora fin</th>
                    <th>Comensales</th>
                    <th>Estado</th>
                    <th>Solicitudes especiales</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reservas as $reserva)
                <tr>
                    <td>
                        <span class="badge bg-secondary">
                            <i class="fas fa-chair"></i> #{{ $reserva->mesa->numero ?? '-' }}
                        </span>
                    </td>
                    <td>{{ \Carbon\Carbon::parse($reserva->fecha_reservacion)->format('d/m/Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($reserva->hora_reservacion)->format('H:i') }}</td>
                    <td>{{ \Carbon\Carbon::parse($reserva->hora_fin)->format('H:i') }}</td>
                    <td>{{ $reserva->numero_comensales }}</td>
                    <td>
                        @if($reserva->estado === 'confirmada')
                            <span class="badge bg-success">Confirmada</span>
                        @elseif($reserva->estado === 'pendiente')
                            <span class="badge bg-warning text-dark">Pendiente</span>
                        @elseif($reserva->estado === 'cancelada')
                            <span class="badge bg-danger">Cancelada</span>
                        @else
                            <span class="badge bg-secondary">{{ ucfirst($reserva->estado) }}</span>
                        @endif
                    </td>
                    <td>{{ $reserva->solicitudes_especiales ?? '-' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
