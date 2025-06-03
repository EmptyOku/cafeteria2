@extends('layouts.empleado')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Estado actual de las mesas</h1>

    <div class="row">
        @foreach ($mesas as $mesa)
            <div class="col-md-3 mb-3">
                <div class="card text-center
                    @if ($mesa->estado_real == 'disponible') border-success
                    @elseif ($mesa->estado_real == 'reservada') border-warning
                    @else border-secondary @endif
                ">
                    <div class="card-body">
                        <h5 class="card-title">Mesa #{{ $mesa->numero }}</h5>
                        <p class="card-text">
                            Estado:
                            <span class="badge
                                @if ($mesa->estado_real == 'disponible') bg-success
                                @elseif ($mesa->estado_real == 'reservada') bg-warning text-dark
                                @endif
                            ">
                                {{ ucfirst($mesa->estado_real) }}
                            </span>
                        </p>
                        @if ($mesa->estado_real == 'reservada')
                            <small class="text-muted">Reservada hasta {{ $mesa->reservas->first()->hora_fin ?? 'hora indefinida' }}</small>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
