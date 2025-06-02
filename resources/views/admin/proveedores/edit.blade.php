@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="mb-0" style="color: #e85d1f;">Editar Proveedor</h1>
    <a href="{{ route('admin.proveedores.index') }}" class="btn btn-secondary">Volver</a>
</div>

<div class="card shadow-sm categorias-card">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.proveedores.update', $proveedor) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nombre" class="form-label" style="color: #e85d1f;">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre', $proveedor->nombre) }}" required>
                @error('nombre')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="contacto" class="form-label" style="color: #e85d1f;">Contacto</label>
                <input type="text" name="contacto" id="contacto" class="form-control" value="{{ old('contacto', $proveedor->contacto) }}">
                @error('contacto')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="telefono" class="form-label" style="color: #e85d1f;">Teléfono</label>
                <input type="text" name="telefono" id="telefono" class="form-control" value="{{ old('telefono', $proveedor->telefono) }}">
                @error('telefono')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="correo" class="form-label" style="color: #e85d1f;">Correo</label>
                <input type="email" name="correo" id="correo" class="form-control" value="{{ old('correo', $proveedor->correo) }}">
                @error('correo')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="direccion" class="form-label" style="color: #e85d1f;">Dirección</label>
                <textarea name="direccion" id="direccion" class="form-control">{{ old('direccion', $proveedor->direccion) }}</textarea>
                @error('direccion')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-naranja">
                <i class="bi bi-save"></i> Actualizar
            </button>
        </form>
    </div>
</div>
@endsection

