{{-- filepath: f:\cafeteria2\resources\views\admin\gastos\create.blade.php --}}
@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0" style="color: #e85d1f;">Nuevo Gasto</h1>
        <a href="{{ route('gastos.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Volver
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('gastos.store') }}">
                @csrf

                <div class="mb-3">
                    <label for="usuario_id" class="form-label">Usuario *</label>
                    <select name="usuario_id" id="usuario_id" class="form-select @error('usuario_id') is-invalid @enderror" required>
                        <option value="">Selecciona un usuario</option>
                        @foreach($usuarios as $usuario)
                            <option value="{{ $usuario->id }}" {{ old('usuario_id') == $usuario->id ? 'selected' : '' }}>
                                {{ $usuario->nombre ?? 'Usuario #'.$usuario->id }}
                            </option>
                        @endforeach
                    </select>
                    @error('usuario_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="monto" class="form-label">Monto *</label>
                    <input type="number" step="0.01" min="0" name="monto" id="monto"
                        class="form-control @error('monto') is-invalid @enderror"
                        value="{{ old('monto') }}" required>
                    @error('monto')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="categoria" class="form-label">Categoría *</label>
                    <input type="text" name="categoria" id="categoria"
                        class="form-control @error('categoria') is-invalid @enderror"
                        value="{{ old('categoria') }}" maxlength="255" required>
                    @error('categoria')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="fecha" class="form-label">Fecha *</label>
                    <input type="date" name="fecha" id="fecha"
                        class="form-control @error('fecha') is-invalid @enderror"
                        value="{{ old('fecha', date('Y-m-d')) }}" required>
                    @error('fecha')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <input type="text" name="descripcion" id="descripcion"
                        class="form-control @error('descripcion') is-invalid @enderror"
                        value="{{ old('descripcion') }}" maxlength="255">
                    @error('descripcion')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="comprobante" class="form-label">Comprobante</label>
                    <input type="text" name="comprobante" id="comprobante"
                        class="form-control @error('comprobante') is-invalid @enderror"
                        value="{{ old('comprobante') }}" maxlength="255">
                    @error('comprobante')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="relacion_inventario" class="form-label">Inventario Relacionado</label>
                    <select name="relacion_inventario" id="relacion_inventario" class="form-select @error('relacion_inventario') is-invalid @enderror">
                        <option value="">Sin relación</option>
                        @foreach($inventarios as $inventario)
                            <option value="{{ $inventario->id }}" {{ old('relacion_inventario') == $inventario->id ? 'selected' : '' }}>
                                {{ $inventario->producto ?? 'Inventario #'.$inventario->id }}
                            </option>
                        @endforeach
                    </select>
                    @error('relacion_inventario')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-naranja">Guardar Gasto</button>
            </form>
        </div>
    </div>
@endsection
