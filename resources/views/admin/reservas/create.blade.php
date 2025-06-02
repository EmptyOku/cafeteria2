@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0" style="color: #e85d1f;">Nueva Reserva</h1>
        <a href="{{ route('admin.reservas.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Volver
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.reservas.store') }}">
                @csrf

                <div class="mb-3">
                    <label for="usuario_id" class="form-label">Usuario *</label>
                    <select name="usuario_id" id="usuario_id" class="form-select @error('usuario_id') is-invalid @enderror" required>
                        <option value="">Selecciona un usuario</option>
                        @foreach($usuarios as $usuario)
                            <option value="{{ $usuario->id }}" {{ old('usuario_id') == $usuario->id ? 'selected' : '' }}>
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
                            <option value="{{ $mesa->id }}" {{ old('mesa_id') == $mesa->id ? 'selected' : '' }}>
                                Mesa #{{ $mesa->numero }}
                            </option>
                        @endforeach
                    </select>
                    @error('mesa_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="fecha_reservacion" class="form-label">Fecha de reservación *</label>
                    <input type="date" name="fecha_reservacion" id="fecha_reservacion"
                        class="form-control @error('fecha_reservacion') is-invalid @enderror"
                        value="{{ old('fecha_reservacion') }}" required>
                    @error('fecha_reservacion')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="hora_reservacion" class="form-label">Hora de inicio *</label>
                    <input type="time" name="hora_reservacion" id="hora_reservacion"
                        class="form-control @error('hora_reservacion') is-invalid @enderror"
                        value="{{ old('hora_reservacion') }}" required>
                    @error('hora_reservacion')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="hora_fin" class="form-label">Hora de fin *</label>
                    <input type="time" name="hora_fin" id="hora_fin"
                        class="form-control @error('hora_fin') is-invalid @enderror"
                        value="{{ old('hora_fin') }}" required>
                    @error('hora_fin')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="numero_comensales" class="form-label">Número de comensales *</label>
                    <input type="number" min="1" name="numero_comensales" id="numero_comensales"
                        class="form-control @error('numero_comensales') is-invalid @enderror"
                        value="{{ old('numero_comensales') }}" required>
                    @error('numero_comensales')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="estado" class="form-label">Estado *</label>
                    <select name="estado" id="estado" class="form-select @error('estado') is-invalid @enderror" required>
                        <option value="pendiente" {{ old('estado') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                        <option value="confirmada" {{ old('estado') == 'confirmada' ? 'selected' : '' }}>Confirmada</option>
                        <option value="cancelada" {{ old('estado') == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
                    </select>
                    @error('estado')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="solicitudes_especiales" class="form-label">Solicitudes especiales</label>
                    <textarea name="solicitudes_especiales" id="solicitudes_especiales"
                        class="form-control @error('solicitudes_especiales') is-invalid @enderror"
                        maxlength="255">{{ old('solicitudes_especiales') }}</textarea>
                    @error('solicitudes_especiales')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-naranja">Guardar Reserva</button>
            </form>
        </div>
    </div>
@endsection
