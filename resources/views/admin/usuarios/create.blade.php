@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="mb-0" style="color: #e85d1f;">Nuevo Usuario</h1>
    <a href="{{ route('admin.usuarios.index') }}" class="btn btn-secondary">Volver</a>
</div>

<div class="card shadow-sm categorias-card">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.usuarios.store') }}">
            @csrf

            <div class="mb-3">
                <label for="nombre" class="form-label" style="color: #e85d1f;">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre') }}" required>
                @error('nombre')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="correo" class="form-label" style="color: #e85d1f;">Correo</label>
                <input type="email" name="correo" id="correo" class="form-control" value="{{ old('correo') }}" required>
                @error('correo')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="contrasena" class="form-label" style="color: #e85d1f;">Contraseña</label>
                <input type="password" name="contrasena" id="contrasena" class="form-control" required>
                @error('contrasena')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="rol" class="form-label" style="color: #e85d1f;">Rol</label>
                <select name="rol" id="rol" class="form-select" required>
                    <option value="">Seleccione un rol</option>
                    @foreach($roles as $rol)
                        <option value="{{ $rol }}" {{ old('rol') == $rol ? 'selected' : '' }}>{{ ucfirst($rol) }}</option>
                    @endforeach
                </select>
                @error('rol')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="telefono" class="form-label" style="color: #e85d1f;">Teléfono</label>
                <input type="text" name="telefono" id="telefono" class="form-control" value="{{ old('telefono') }}">
                @error('telefono')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="direccion" class="form-label" style="color: #e85d1f;">Dirección</label>
                <textarea name="direccion" id="direccion" class="form-control">{{ old('direccion') }}</textarea>
                @error('direccion')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-naranja">
                <i class="bi bi-save"></i> Guardar
            </button>
        </form>
    </div>
</div>
@endsection
