@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="mb-0" style="color: #e85d1f;">Nueva Categoría</h1>
    <a href="{{ route('admin.categorias.index') }}" class="btn btn-secondary">Volver</a>
</div>

<div class="card shadow-sm categorias-card">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.categorias.store') }}">
            @csrf

            <div class="mb-3">
                <label for="nombre" class="form-label" style="color: #e85d1f;">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre') }}" required>
                @error('nombre')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label" style="color: #e85d1f;">Descripción</label>
                <textarea name="descripcion" id="descripcion" class="form-control">{{ old('descripcion') }}</textarea>
                @error('descripcion')
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
