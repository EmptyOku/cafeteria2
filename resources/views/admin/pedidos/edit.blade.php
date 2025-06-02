@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0" style="color: #e85d1f;">Editar Pedido</h1>
        <a href="{{ route('admin.pedidos.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Volver
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.pedidos.update', $pedido->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="usuario_id" class="form-label">Usuario *</label>
                    <select name="usuario_id" id="usuario_id" class="form-select @error('usuario_id') is-invalid @enderror" required>
                        <option value="">Selecciona un usuario</option>
                        @foreach($usuarios as $usuario)
                            <option value="{{ $usuario->id }}" {{ old('usuario_id', $pedido->usuario_id) == $usuario->id ? 'selected' : '' }}>
                                {{ $usuario->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('usuario_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="mesa_id" class="form-label">Mesa *</label>
                    <select name="mesa_id" id="mesa_id" class="form-select @error('mesa_id') is-invalid @enderror" required>
                        <option value="">Selecciona una mesa</option>
                        @foreach($mesas as $mesa)
                            <option value="{{ $mesa->id }}" {{ old('mesa_id', $pedido->mesa_id) == $mesa->id ? 'selected' : '' }}>
                                {{ $mesa->nombre ?? 'Mesa #' . $mesa->id }}
                            </option>
                        @endforeach
                    </select>
                    @error('mesa_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="estado" class="form-label">Estado *</label>
                    <select name="estado" id="estado" class="form-select @error('estado') is-invalid @enderror" required>
                        <option value="pendiente" {{ old('estado', $pedido->estado) == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                        <option value="completado" {{ old('estado', $pedido->estado) == 'completado' ? 'selected' : '' }}>Completado</option>
                        <option value="cancelado" {{ old('estado', $pedido->estado) == 'cancelado' ? 'selected' : '' }}>Cancelado</option>
                    </select>
                    @error('estado')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="monto_total" class="form-label">Monto Total *</label>
                    <input type="number" step="0.01" min="0" name="monto_total" id="monto_total"
                        class="form-control @error('monto_total') is-invalid @enderror"
                        value="{{ old('monto_total', $pedido->monto_total) }}" required>
                    @error('monto_total')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="metodo_pago" class="form-label">Método de Pago</label>
                    <select name="metodo_pago" id="metodo_pago" class="form-select @error('metodo_pago') is-invalid @enderror">
                        <option value="">Selecciona un método</option>
                        <option value="efectivo" {{ old('metodo_pago', $pedido->metodo_pago) == 'efectivo' ? 'selected' : '' }}>Efectivo</option>
                        <option value="tarjeta" {{ old('metodo_pago', $pedido->metodo_pago) == 'tarjeta' ? 'selected' : '' }}>Tarjeta</option>
                        <option value="transferencia" {{ old('metodo_pago', $pedido->metodo_pago) == 'transferencia' ? 'selected' : '' }}>Transferencia</option>
                        <option value="otro" {{ old('metodo_pago', $pedido->metodo_pago) == 'otro' ? 'selected' : '' }}>Otro</option>
                    </select>
                    @error('metodo_pago')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="estado_pago" class="form-label">Estado de Pago</label>
                    <select name="estado_pago" id="estado_pago" class="form-select @error('estado_pago') is-invalid @enderror">
                        <option value="">Selecciona un estado</option>
                        <option value="pendiente" {{ old('estado_pago', $pedido->estado_pago) == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                        <option value="pagado" {{ old('estado_pago', $pedido->estado_pago) == 'pagado' ? 'selected' : '' }}>Pagado</option>
                    </select>
                    @error('estado_pago')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="notas" class="form-label">Notas</label>
                    <textarea name="notas" id="notas" class="form-control @error('notas') is-invalid @enderror" maxlength="255">{{ old('notas', $pedido->notas) }}</textarea>
                    @error('notas')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-naranja">Actualizar Pedido</button>
            </form>
        </div>
    </div>
@endsection
