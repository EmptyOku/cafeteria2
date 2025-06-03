{{-- filepath: resources/views/cliente/reservas/index.blade.php --}}
@extends('layouts.navigation')

@section('content')
<div class=" justify-content-between align-items-center mb-3 container-fluid">
    <h2 class="mb-4 text-center"><i class="fas fa-chair"></i> Reservar Mesa</h2>
    <a href="{{ route('cliente.reservas.show') }}" class="btn btn-naranja">Mis reservas</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="row mb-4">
        @foreach($mesas as $mesa)
            <div class="col-6 col-md-3 mb-3 text-center">
                <button class="btn btn-outline-primary mesa-btn" data-mesa="{{ $mesa->id }}">
                    <i class="fas fa-chair fa-3x"></i><br>
                    Mesa #{{ $mesa->numero }}<br>
                    <small>Capacidad: {{ $mesa->capacidad }}</small>
                </button>
            </div>
        @endforeach
    </div>
    <form method="POST" action="{{ route('cliente.reservas.store') }}" id="reservaForm">
        @csrf
        <input type="hidden" name="mesa_id" id="mesa_id" required>
        <div class="mb-3">
            <label for="fecha_reservacion" class="form-label">Fecha</label>
            <input type="date" name="fecha_reservacion" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="hora_reservacion" class="form-label">Hora inicio</label>
            <input type="time" name="hora_reservacion" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="hora_fin" class="form-label">Hora fin</label>
            <input type="time" name="hora_fin" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="numero_comensales" class="form-label">Número de comensales</label>
            <input type="number" name="numero_comensales" class="form-control" min="1" required>
        </div>
        <div class="mb-3">
            <label for="solicitudes_especiales" class="form-label">Solicitudes especiales</label>
            <textarea name="solicitudes_especiales" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-success">Reservar</button>
    </form>
</div>
<script>
    document.querySelectorAll('.mesa-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('mesa_id').value = this.dataset.mesa;
            document.querySelectorAll('.mesa-btn').forEach(b => b.classList.remove('btn-primary'));
            this.classList.add('btn-primary');
        });
    });
</script>
@endsection
