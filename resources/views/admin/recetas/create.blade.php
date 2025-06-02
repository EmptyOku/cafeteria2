@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0" style="color: #e85d1f;">Nueva Receta</h1>
        <a href="{{ route('recetas.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Volver
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('recetas.store') }}">
                @csrf

                <div class="mb-3">
                    <label for="producto_id" class="form-label">Producto *</label>
                    <select name="producto_id" id="producto_id" class="form-select @error('producto_id') is-invalid @enderror" required>
                        <option value="">Selecciona un producto</option>
                        @foreach($productos as $producto)
                            <option value="{{ $producto->id }}" {{ old('producto_id') == $producto->id ? 'selected' : '' }}>
                                {{ $producto->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('producto_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="insumo_id" class="form-label">Insumo *</label>
                    <select name="insumo_id" id="insumo_id" class="form-select @error('insumo_id') is-invalid @enderror" required>
                        <option value="">Selecciona un insumo</option>
                        @foreach($insumos as $insumo)
                            <option value="{{ $insumo->id }}" {{ old('insumo_id') == $insumo->id ? 'selected' : '' }}>
                                {{ $insumo->producto }}
                            </option>
                        @endforeach
                    </select>
                    @error('insumo_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="cantidad" class="form-label">Cantidad *</label>
                    <input type="number" step="0.01" min="0" name="cantidad" id="cantidad"
                        class="form-control @error('cantidad') is-invalid @enderror"
                        value="{{ old('cantidad') }}" required>
                    @error('cantidad')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="instrucciones" class="form-label">Instrucciones</label>
                    <textarea name="instrucciones" id="instrucciones" class="form-control @error('instrucciones') is-invalid @enderror"
                        maxlength="500">{{ old('instrucciones') }}</textarea>
                    @error('instrucciones')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-naranja">Guardar Receta</button>
            </form>
        </div>
    </div>
@endsection
