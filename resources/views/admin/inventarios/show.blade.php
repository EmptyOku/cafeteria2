@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="mb-0" style="color: #e85d1f;">Detalle de Producto de Inventario</h1>
    <a href="{{ route('admin.inventarios.index') }}" class="btn btn-secondary">Volver</a>
</div>

<div class="card shadow-sm categorias-card">
    <div class="card-body">
        <dl class="row">
            <dt class="col-sm-3">Producto</dt>
            <dd class="col-sm-9">{{ $inventario->producto }}</dd>

            <dt class="col-sm-3">Descripción</dt>
            <dd class="col-sm-9">{{ $inventario->descripcion ?? '-' }}</dd>

            <dt class="col-sm-3">Cantidad en inventario</dt>
            <dd class="col-sm-9">{{ $inventario->cantidad }}</dd>

            <dt class="col-sm-3">Unidad (venta)</dt>
            <dd class="col-sm-9">{{ $inventario->unidad }}</dd>

            <dt class="col-sm-3">Nivel de reorden</dt>
            <dd class="col-sm-9">{{ $inventario->nivel_reorden ?? '-' }}</dd>

            <dt class="col-sm-3">Precio de compra (por unidad)</dt>
            <dd class="col-sm-9">
                {{ $inventario->costo_por_unidad ? '$' . number_format($inventario->costo_por_unidad, 2) : '-' }}
            </dd>

            <dt class="col-sm-3">Ubicación en almacén</dt>
            <dd class="col-sm-9">{{ $inventario->ubicacion_almacen ?? '-' }}</dd>

            <dt class="col-sm-3">Proveedor</dt>
            <dd class="col-sm-9">{{ $inventario->proveedor->nombre ?? '-' }}</dd>

            <dt class="col-sm-3">Fecha de creación</dt>
            <dd class="col-sm-9">{{ $inventario->created_at ? $inventario->created_at->format('d/m/Y H:i') : '-' }}</dd>

            <dt class="col-sm-3">Última actualización</dt>
            <dd class="col-sm-9">{{ $inventario->updated_at ? $inventario->updated_at->format('d/m/Y H:i') : '-' }}</dd>
        </dl>
    </div>
</div>
@endsection
