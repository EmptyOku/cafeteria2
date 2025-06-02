@extends('layouts.admin')

@section('content')
    <h1 class="mb-4" style="color: #e85d1f;">Editar Mesa</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.mesas.update', $mesa) }}" method="POST" class="card shadow-sm p-4">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="numero" class="form-label">Número de Mesa</label>
            <input type="number" name="numero" id="numero" class="form-control" value="{{ old('numero', $mesa->numero) }}" required min="1">
        </div>

        <div class="mb-3">
            <label for="capacidad" class="form-label">Capacidad</label>
            <input type="number" name="capacidad" id="capacidad" class="form-control" value="{{ old('capacidad', $mesa->capacidad) }}" required min="1">
        </div>

        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select name="estado" id="estado" class="form-select" required>
                <option value="disponible" {{ old('estado', $mesa->estado) == 'disponible' ? 'selected' : '' }}>Disponible</option>
                <option value="ocupada" {{ old('estado', $mesa->estado) == 'ocupada' ? 'selected' : '' }}>Ocupada</option>
                <option value="reservada" {{ old('estado', $mesa->estado) == 'reservada' ? 'selected' : '' }}>Reservada</option>
                <option value="mantenimiento" {{ old('estado', $mesa->estado) == 'mantenimiento' ? 'selected' : '' }}>En mantenimiento</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="ubicacion" class="form-label">Ubicación</label>
            <input type="text" name="ubicacion" id="ubicacion" class="form-control" value="{{ old('ubicacion', $mesa->ubicacion) }}" maxlength="255">
        </div>

        <div class="d-flex justify-content-end">
            <a href="{{ route('admin.mesas.index') }}" class="btn btn-secondary me-2">Cancelar</a>
            <button type="submit" class="btn btn-naranja">Actualizar Mesa</button>
        </div>
    </form>
@endsection
