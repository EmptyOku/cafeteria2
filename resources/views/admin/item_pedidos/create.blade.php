{{-- filepath: f:\cafeteria2\resources\views\admin\item_pedidos\create.blade.php --}}
@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0" style="color: #e85d1f;">Nuevo Ítem de Pedido</h1>
        <a href="{{ route('item_pedidos.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Volver
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('item_pedidos.store') }}">
                @csrf

                <div class="mb-3">
                    <label for="pedido_id" class="form-label">Pedido *</label>
                    <select name="pedido_id" id="pedido_id" class="form-select @error('pedido_id') is-invalid @enderror" required>
                        <option value="">Selecciona un pedido</option>
                        @foreach($pedidos as $pedido)
                            <option value="{{ $pedido->id }}" {{ old('pedido_id') == $pedido->id ? 'selected' : '' }}>
                                Pedido #{{ $pedido->id }}
                            </option>
                        @endforeach
                    </select>
                    @error('pedido_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="producto_id" class="form-label">Producto *</label>
                    <select name="producto_id" id="producto_id" class="form-select @error('producto_id') is-invalid @enderror" required>
                        <option value="">Selecciona un producto</option>
                        @foreach($productos as $producto)
                            <option value="{{ $producto->id }}" {{ old('producto_id') == $producto->id ? 'selected' : '' }}>
                                {{ $producto->nombre ?? 'Producto #'.$producto->id }}
                            </option>
                        @endforeach
                    </select>
                    @error('producto_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="cantidad" class="form-label">Cantidad *</label>
                    <input type="number" min="1" name="cantidad" id="cantidad"
                        class="form-control @error('cantidad') is-invalid @enderror"
                        value="{{ old('cantidad') }}" required>
                    @error('cantidad')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="precio_unitario" class="form-label">Precio Unitario *</label>
                    <input type="number" step="0.01" min="0" name="precio_unitario" id="precio_unitario"
                        class="form-control @error('precio_unitario') is-invalid @enderror"
                        value="{{ old('precio_unitario') }}" required>
                    @error('precio_unitario')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="solicitudes_especiales" class="form-label">Solicitudes Especiales</label>
                    <input type="text" name="solicitudes_especiales" id="solicitudes_especiales"
                        class="form-control @error('solicitudes_especiales') is-invalid @enderror"
                        value="{{ old('solicitudes_especiales') }}" maxlength="255">
                    @error('solicitudes_especiales')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-naranja">Guardar Ítem</button>
            </form>
        </div>
    </div>
@endsection
