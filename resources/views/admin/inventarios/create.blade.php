@extends('layouts.admin')

@section('content')
    <h1 class="mb-4" style="color: #e85d1f;">Nuevo Producto de Inventario</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.inventarios.store') }}" method="POST" class="card shadow-sm p-4">
        @csrf

        <div class="mb-3">
            <label for="producto" class="form-label">Producto</label>
            <input type="text" name="producto" id="producto" class="form-control" value="{{ old('producto') }}" required>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea name="descripcion" id="descripcion" class="form-control" maxlength="500">{{ old('descripcion') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="cantidad" class="form-label">Cantidad</label>
            <input type="number" name="cantidad" id="cantidad" class="form-control" value="{{ old('cantidad') }}" min="0" required>
        </div>

        <div class="mb-3">
            <label for="unidad" class="form-label">Unidad</label>
            <input type="text" name="unidad" id="unidad" class="form-control" value="{{ old('unidad') }}" required>
        </div>

        <div class="mb-3">
            <label for="nivel_reorden" class="form-label">Nivel de Reorden</label>
            <input type="number" name="nivel_reorden" id="nivel_reorden" class="form-control" value="{{ old('nivel_reorden') }}" min="0">
        </div>

        <div class="mb-3">
            <label for="costo_por_unidad" class="form-label">Costo por Unidad</label>
            <input type="number" step="0.01" name="costo_por_unidad" id="costo_por_unidad" class="form-control" value="{{ old('costo_por_unidad') }}" min="0">
        </div>

        <div class="mb-3">
            <label for="ubicacion_almacen" class="form-label">Ubicación en Almacén</label>
            <input type="text" name="ubicacion_almacen" id="ubicacion_almacen" class="form-control" value="{{ old('ubicacion_almacen') }}">
        </div>

        <div class="mb-3">
            <label for="proveedor_id" class="form-label">Proveedor</label>
            <select name="proveedor_id" id="proveedor_id" class="form-select">
                <option value="">Seleccione un proveedor</option>
                @foreach($proveedores as $proveedor)
                    <option value="{{ $proveedor->id }}" {{ old('proveedor_id') == $proveedor->id ? 'selected' : '' }}>
                        {{ $proveedor->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="d-flex justify-content-end">
            <a href="{{ route('admin.inventarios.index') }}" class="btn btn-secondary me-2">Cancelar</a>
            <button type="submit" class="btn btn-naranja">Guardar Producto</button>
        </div>
    </form>
@endsection
