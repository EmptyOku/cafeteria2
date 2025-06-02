@extends('layouts.admin')

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0" style="color: #e85d1f;">Pedidos</h1>
        <a href="{{ route('admin.pedidos.create') }}" class="btn btn-naranja">
            <i class="bi bi-plus"></i> Nuevo Pedido
        </a>
    </div>

    <h4 class="mb-2">Pedidos de hoy</h4>
    <div class="card shadow-sm categorias-card mb-4">
        <div class="card-body p-0">
            <table class="table categorias-table mb-0">
                <thead class="categorias-thead">
                    <tr>
                        <th>#</th>
                        <th>Mesa</th>
                        <th>Usuario</th>
                        <th>Estado</th>
                        <th>Monto Total</th>
                        <th>Hora</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pedidos->filter(fn($p) => $p->created_at->isToday()) as $pedido)
                        <tr>
                            <td>{{ $pedido->numero_pedido }}</td>
                            <td>
                                @if($pedido->mesa)
                                    Mesa #{{ $pedido->mesa->numero }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{ $pedido->usuario->nombre ?? '-' }}</td>
                            <td>
                                <span class="badge bg-{{ $pedido->estado == 'completado' ? 'success' : ($pedido->estado == 'cancelado' ? 'danger' : 'warning') }}">
                                    {{ ucfirst($pedido->estado) }}
                                </span>
                            </td>
                            <td>${{ number_format($pedido->monto_total, 2) }}</td>
                            <td>{{ $pedido->created_at->format('H:i') }}</td>
                            <td class="text-end">
                                <a href="{{ route('admin.pedidos.show', $pedido) }}" class="btn btn-sm btn-primary">Ver</a>
                                <a href="{{ route('admin.pedidos.edit', $pedido) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i> Editar</a>
                                <form method="POST" action="{{ route('admin.pedidos.destroy', $pedido) }}" style="display:inline-block" onsubmit="return confirm('¿Eliminar pedido?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i> Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No hay pedidos para hoy.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <h4 class="mb-2">Pedidos anteriores</h4>
    <div class="card shadow-sm categorias-card">
        <div class="card-body p-0">
            <table class="table categorias-table mb-0">
                <thead class="categorias-thead">
                    <tr>
                        <th>#</th>
                        <th>Mesa</th>
                        <th>Usuario</th>
                        <th>Estado</th>
                        <th>Monto Total</th>
                        <th>Fecha</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pedidos->filter(fn($p) => !$p->created_at->isToday()) as $pedido)
                        <tr>
                            <td>{{ $pedido->numero_pedido }}</td>
                            <td>
                                @if($pedido->mesa)
                                    Mesa #{{ $pedido->mesa->numero }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{ $pedido->usuario->nombre ?? '-' }}</td>
                            <td>
                                <span class="badge bg-{{ $pedido->estado == 'completado' ? 'success' : ($pedido->estado == 'cancelado' ? 'danger' : 'warning') }}">
                                    {{ ucfirst($pedido->estado) }}
                                </span>
                            </td>
                            <td>${{ number_format($pedido->monto_total, 2) }}</td>
                            <td>{{ $pedido->created_at->format('d/m/Y H:i') }}</td>
                            <td class="text-end">
                                <a href="{{ route('admin.pedidos.show', $pedido) }}" class="btn btn-sm btn-primary">Ver</a>
                                <a href="{{ route('admin.pedidos.edit', $pedido) }}" class="btn btn-sm btn-warning">Editar</a>
                                <form method="POST" action="{{ route('admin.pedidos.destroy', $pedido) }}" style="display:inline-block" onsubmit="return confirm('¿Eliminar pedido?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No hay pedidos anteriores.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
