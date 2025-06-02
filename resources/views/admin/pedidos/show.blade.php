@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="mb-0" style="color: #e85d1f;">Detalle del Pedido</h1>
    <a href="{{ route('admin.pedidos.index') }}" class="btn btn-secondary">Volver</a>
</div>

<div class="card shadow-sm categorias-card">
    <div class="card-body">
        <dl class="row">
            <dt class="col-sm-3">Número de Pedido</dt>
            <dd class="col-sm-9">{{ $pedido->numero_pedido ?? $pedido->id }}</dd>

            <dt class="col-sm-3">Usuario</dt>
            <dd class="col-sm-9">{{ $pedido->usuario->nombre ?? '-' }}</dd>

            <dt class="col-sm-3">Mesa</dt>
            <dd class="col-sm-9">{{ $pedido->mesa->numero ?? '-' }}</dd>

            <dt class="col-sm-3">Estado</dt>
            <dd class="col-sm-9">{{ ucfirst($pedido->estado) }}</dd>

            <dt class="col-sm-3">Notas</dt>
            <dd class="col-sm-9">{{ $pedido->notas ?? '-' }}</dd>

            <dt class="col-sm-3">Monto Total</dt>
            <dd class="col-sm-9">${{ number_format($pedido->monto_total, 2) }}</dd>

            <dt class="col-sm-3">Método de Pago</dt>
            <dd class="col-sm-9">{{ ucfirst($pedido->metodo_pago) ?? '-' }}</dd>

            <dt class="col-sm-3">Estado de Pago</dt>
            <dd class="col-sm-9">{{ ucfirst($pedido->estado_pago) ?? '-' }}</dd>

            <dt class="col-sm-3">Fecha de creación</dt>
            <dd class="col-sm-9">{{ $pedido->created_at ? $pedido->created_at->format('d/m/Y H:i') : '-' }}</dd>

            <dt class="col-sm-3">Última actualización</dt>
            <dd class="col-sm-9">{{ $pedido->updated_at ? $pedido->updated_at->format('d/m/Y H:i') : '-' }}</dd>
        </dl>
    </div>
</div>
@endsection
