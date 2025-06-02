
@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="mb-0" style="color: #e85d1f;">Detalle de Proveedor</h1>
    <a href="{{ route('admin.proveedores.index') }}" class="btn btn-secondary">Volver</a>
</div>

<div class="card shadow-sm categorias-card">
    <div class="card-body">
        <dl class="row">
            <dt class="col-sm-3">Nombre</dt>
            <dd class="col-sm-9">{{ $proveedor->nombre }}</dd>

            <dt class="col-sm-3">Contacto</dt>
            <dd class="col-sm-9">{{ $proveedor->contacto ?? '-' }}</dd>

            <dt class="col-sm-3">Teléfono</dt>
            <dd class="col-sm-9">{{ $proveedor->telefono ?? '-' }}</dd>

            <dt class="col-sm-3">Correo</dt>
            <dd class="col-sm-9">{{ $proveedor->correo ?? '-' }}</dd>

            <dt class="col-sm-3">Dirección</dt>
            <dd class="col-sm-9">{{ $proveedor->direccion ?? '-' }}</dd>

            <dt class="col-sm-3">Fecha de creación</dt>
            <dd class="col-sm-9">{{ $proveedor->created_at ? $proveedor->created_at->format('d/m/Y H:i') : '-' }}</dd>

            <dt class="col-sm-3">Última actualización</dt>
            <dd class="col-sm-9">{{ $proveedor->updated_at ? $proveedor->updated_at->format('d/m/Y H:i') : '-' }}</dd>
        </dl>
    </div>
</div>
@endsection
