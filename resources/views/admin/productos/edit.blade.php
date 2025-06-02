@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0" style="color: #e85d1f;">Editar Producto</h1>
        <a href="{{ route('admin.productos.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Volver
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.productos.update', $producto->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre *</label>
                    <input type="text" name="nombre" id="nombre" class="form-control @error('nombre') is-invalid @enderror"
                        value="{{ old('nombre', $producto->nombre) }}" required maxlength="255">
                    @error('nombre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea name="descripcion" id="descripcion" class="form-control @error('descripcion') is-invalid @enderror"
                        maxlength="500">{{ old('descripcion', $producto->descripcion) }}</textarea>
                    @error('descripcion')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="precio" class="form-label">Precio *</label>
                    <input type="number" step="0.01" min="0" name="precio" id="precio"
                        class="form-control @error('precio') is-invalid @enderror"
                        value="{{ old('precio', $producto->precio) }}" required>
                    @error('precio')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="categoria_id" class="form-label">Categoría *</label>
                    <select name="categoria_id" id="categoria_id" class="form-select @error('categoria_id') is-invalid @enderror" required>
                        <option value="">Selecciona una categoría</option>
                        @foreach($categorias as $categoria)
                            <option value="{{ $categoria->id }}" {{ old('categoria_id', $producto->categoria_id) == $categoria->id ? 'selected' : '' }}>
                                {{ $categoria->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('categoria_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="costo_base" class="form-label">Costo base</label>
                    <input type="number" step="0.01" min="0" name="costo_base" id="costo_base"
                        class="form-control @error('costo_base') is-invalid @enderror"
                        value="{{ old('costo_base', $producto->costo_base) }}">
                    @error('costo_base')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="imagen" class="form-label">Imagen (URL)</label>
                    <input type="text" name="imagen" id="imagen" class="form-control @error('imagen') is-invalid @enderror"
                        value="{{ old('imagen', $producto->imagen) }}" maxlength="255">
                    @error('imagen')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="inventario" class="form-label">Inventario</label>
                    <input type="number" min="0" name="inventario" id="inventario"
                        class="form-control @error('inventario') is-invalid @enderror"
                        value="{{ old('inventario', $producto->inventario) }}">
                    @error('inventario')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="esta_activo" id="esta_activo"
                        value="1" {{ old('esta_activo', $producto->esta_activo) ? 'checked' : '' }}>
                    <label class="form-check-label" for="esta_activo">
                        Producto activo
                    </label>
                </div>

                <button type="submit" class="btn btn-naranja">Actualizar Producto</button>
            </form>
        </div>
    </div>
@endsection
