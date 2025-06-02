@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="mb-0" style="color: #e85d1f;">Detalle de Producto</h1>
    <a href="{{ route('admin.productos.index') }}" class="btn btn-secondary">Volver</a>
</div>

<div class="card shadow-sm categorias-card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-4 mb-3 text-center">
                @if($producto->imagen)
                    <img src="{{ $producto->imagen }}" alt="Imagen del producto" class="img-fluid rounded" style="max-height: 220px;">
                @else
                    <div class="bg-light border rounded d-flex align-items-center justify-content-center" style="height:220px;">
                        <span class="text-muted">Sin imagen</span>
                    </div>
                @endif
            </div>
            <div class="col-md-8">
                <dl class="row">
                    <dt class="col-sm-4">Nombre</dt>
                    <dd class="col-sm-8">{{ $producto->nombre }}</dd>

                    <dt class="col-sm-4">Descripción</dt>
                    <dd class="col-sm-8">{{ $producto->descripcion ?? '-' }}</dd>

                    <dt class="col-sm-4">Precio</dt>
                    <dd class="col-sm-8">${{ number_format($producto->precio, 2) }}</dd>

                    <dt class="col-sm-4">Categoría</dt>
                    <dd class="col-sm-8">{{ $producto->categoria->nombre ?? '-' }}</dd>

                    <dt class="col-sm-4">Costo base</dt>
                    <dd class="col-sm-8">
                        {{ $producto->costo_base !== null ? '$' . number_format($producto->costo_base, 2) : '-' }}
                    </dd>

                    <dt class="col-sm-4">Inventario</dt>
                    <dd class="col-sm-8">{{ $producto->inventario ?? '-' }}</dd>

                    <dt class="col-sm-4">Activo</dt>
                    <dd class="col-sm-8">
                        @if($producto->esta_activo)
                            <span class="badge bg-success">Sí</span>
                        @else
                            <span class="badge bg-danger">No</span>
                        @endif
                    </dd>

                    <dt class="col-sm-4">Fecha de creación</dt>
                    <dd class="col-sm-8">{{ $producto->created_at ? $producto->created_at->format('d/m/Y H:i') : '-' }}</dd>

                    <dt class="col-sm-4">Última actualización</dt>
                    <dd class="col-sm-8">{{ $producto->updated_at ? $producto->updated_at->format('d/m/Y H:i') : '-' }}</dd>
                </dl>
            </div>
        </div>
    </div>
</div>
@endsection
