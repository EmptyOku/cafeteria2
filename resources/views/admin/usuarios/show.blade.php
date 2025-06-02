@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="mb-0" style="color: #e85d1f;">Detalle de Usuario</h1>
    <a href="{{ route('admin.usuarios.index') }}" class="btn btn-secondary">Volver</a>
</div>

<div class="card shadow-sm categorias-card">
    <div class="card-body">
        <dl class="row">
            <dt class="col-sm-3">Nombre</dt>
            <dd class="col-sm-9">{{ $usuario->nombre }}</dd>

            <dt class="col-sm-3">Correo</dt>
            <dd class="col-sm-9">{{ $usuario->correo }}</dd>

            <dt class="col-sm-3">Correo verificado en</dt>
            <dd class="col-sm-9">
                {{ $usuario->correo_verificado_en ? $usuario->correo_verificado_en->format('d/m/Y H:i') : '-' }}
            </dd>

            <dt class="col-sm-3">Rol (Spatie)</dt>
            <dd class="col-sm-9">
                @if($usuario->getRoleNames()->isNotEmpty())
                    {{ ucfirst($usuario->getRoleNames()->first()) }}
                @else
                    {{ ucfirst($usuario->rol) ?? '-' }}
                @endif
            </dd>

            <dt class="col-sm-3">Rol (campo en tabla)</dt>
            <dd class="col-sm-9">{{ ucfirst($usuario->rol) }}</dd>

            <dt class="col-sm-3">Teléfono</dt>
            <dd class="col-sm-9">{{ $usuario->telefono ?? '-' }}</dd>

            <dt class="col-sm-3">Dirección</dt>
            <dd class="col-sm-9">{{ $usuario->direccion ?? '-' }}</dd>

            <dt class="col-sm-3">Fecha de creación</dt>
            <dd class="col-sm-9">{{ $usuario->created_at ? $usuario->created_at->format('d/m/Y H:i') : '-' }}</dd>

            <dt class="col-sm-3">Última actualización</dt>
            <dd class="col-sm-9">{{ $usuario->updated_at ? $usuario->updated_at->format('d/m/Y H:i') : '-' }}</dd>
        </dl>
    </div>
</div>
@endsection
