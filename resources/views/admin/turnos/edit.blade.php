@extends('layouts.admin')

@section('content')
    <h1 class="mb-4" style="color: #e85d1f;">Editar Turno</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.turnos.update', $turno) }}" method="POST" class="card shadow-sm p-4">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="usuario_id" class="form-label">Usuario</label>
            <select name="usuario_id" id="usuario_id" class="form-select" required>
                <option value="">Seleccione un usuario</option>
                @foreach($usuarios as $usuario)
                    <option value="{{ $usuario->id }}" {{ (old('usuario_id', $turno->usuario_id) == $usuario->id) ? 'selected' : '' }}>
                        {{ $usuario->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="hora_inicio" class="form-label">Hora de Inicio</label>
            <input type="time" name="hora_inicio" id="hora_inicio" class="form-control" value="{{ old('hora_inicio', $turno->hora_inicio) }}" required>
        </div>

        <div class="mb-3">
            <label for="hora_fin" class="form-label">Hora de Fin</label>
            <input type="time" name="hora_fin" id="hora_fin" class="form-control" value="{{ old('hora_fin', $turno->hora_fin) }}" required>
        </div>

        <div class="mb-3">
            <label for="notas" class="form-label">Notas</label>
            <textarea name="notas" id="notas" class="form-control" maxlength="255">{{ old('notas', $turno->notas) }}</textarea>
        </div>

        <div class="d-flex justify-content-end">
            <a href="{{ route('admin.turnos.index') }}" class="btn btn-secondary me-2">Cancelar</a>
            <button type="submit" class="btn btn-naranja">Actualizar Turno</button>
        </div>
    </form>
@endsection
