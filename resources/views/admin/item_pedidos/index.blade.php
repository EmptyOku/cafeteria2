{{-- filepath: f:\cafeteria2\resources\views\admin\item_pedidos\index.blade.php --}}
@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0" style="color: #e85d1f;">Ítems de Pedido</h1>
        <a href="{{ route('admin.item_pedidos.create') }}" class="btn btn-naranja">
            <i class="bi bi-plus"></i> Nuevo Ítem
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Pedido</th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio Unitario</th>
                            <th>Precio Total</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($itemsPedido as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->pedido_id }}</td>
                                <td>{{ $item->producto_id }}</td>
                                <td>{{ $item->cantidad }}</td>
                                <td>${{ number_format($item->precio_unitario, 2) }}</td>
                                <td>${{ number_format($item->precio_total, 2) }}</td>
                                <td>
                                    <a href="{{ route('admin.item_pedidos.show', $item->id) }}" class="btn btn-sm btn-info" title="Ver">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.item_pedidos.edit', $item->id) }}" class="btn btn-sm btn-warning" title="Editar">
                                        <i class="bi bi-pencil"></i> Editar
                                    </a>
                                    <form action="{{ route('admin.item_pedidos.destroy', $item->id) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('¿Seguro que deseas eliminar este ítem?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" title="Eliminar">
                                            <i class="bi bi-trash"></i> Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No hay ítems de pedido registrados.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-3">
        {{ $itemsPedido->links() }}
    </div>
@endsection
