{{-- filepath: f:\cafeteria2\resources\views\empleado\home.blade.php --}}
@extends('layouts.empleado')

@section('content')
<div class="container py-5">
    <div class="card shadow-sm border-0 mx-auto" style="max-width: 600px;">
        <div class="card-body text-center">
            <h2 class="mb-3" style="color:#ff7043;">
                <i class="fas fa-user-tie"></i> Bienvenido, Empleado
            </h2>
            <p class="lead">
                Gestiona mesas, pedidos y tus turnos desde el menú superior.
            </p>
            <hr>
            <div class="row mt-4">
                <div class="col-12 mb-3">
                    <a href="{{ url('/empleado/mesas') }}" class="btn btn-naranja w-100">
                        <i class="fas fa-chair"></i><br>Ver Mesas
                    </a>
                </div>
                <div class="col-12 d-flex gap-2">
                    <form method="POST" action="{{ route('empleado.turnos.entrada') }}" class="w-100">
                        @csrf
                        <button type="submit" class="btn btn-outline-success w-100">
                            <i class="fas fa-sign-in-alt"></i> Marcar Entrada
                        </button>
                    </form>
                    <form method="POST" action="{{ route('empleado.turnos.salida') }}" class="w-100">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger w-100">
                            <i class="fas fa-sign-out-alt"></i> Marcar Salida
                        </button>
                    </form>
                </div>
            </div>
            <p class="mt-4 text-muted">Recuerda cerrar sesión al finalizar tu turno.</p>
            @if(session('success'))
                <div class="alert alert-success mt-3">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger mt-3">{{ session('error') }}</div>
            @endif
        </div>
    </div>
</div>
@endsection
