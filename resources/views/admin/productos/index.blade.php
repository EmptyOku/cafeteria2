@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0" style="color: #e85d1f;">Productos</h1>
        <a href="{{ route('admin.productos.create') }}" class="btn btn-naranja">
            <i class="bi bi-plus-circle"></i> Nuevo Producto
        </a>
    </div>

    <form method="GET" action="{{ route('admin.productos.index') }}" class="row g-3 mb-4">
        <div class="col-md-4">
            <input type="text" name="buscar" class="form-control" placeholder="Buscar por nombre..." value="{{ request('buscar') }}">
        </div>
        <div class="col-md-4">
            <select name="categoria_id" class="form-select">
                <option value="">Todas las categorías</option>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}" {{ request('categoria_id') == $categoria->id ? 'selected' : '' }}>
                        {{ $categoria->nombre }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-naranja w-100">Filtrar</button>
        </div>
        <div class="col-md-2">
            <a href="{{ route('admin.productos.index') }}" class="btn btn-secondary w-100">Limpiar</a>
        </div>
    </form>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($alertaBajoInventario->count())
        <div class="alert alert-warning">
            <strong>¡Atención!</strong> Los siguientes productos están bajos en inventario:
            <ul class="mb-0">
                @foreach($alertaBajoInventario as $producto)
                    <li>{{ $producto->nombre }} (Inventario: {{ $producto->inventario }})</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm categorias-card">
        <div class="card-body p-0">
            <table class="table categorias-table mb-0">
                <thead class="categorias-thead">
                    <tr>
                        <th>Nombre</th>
                        <th>Categoría</th>
                        <th>Precio</th>
                        <th>Inventario</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($productos as $producto)
                        <tr class="{{ $loop->even ? 'fila-naranja-clara' : 'fila-blanca' }}">
                            <td>{{ $producto->nombre }}</td>
                            <td>{{ $producto->categoria->nombre ?? '-' }}</td>
                            <td>${{ number_format($producto->precio, 2) }}</td>
                            <td>
                                @if($producto->inventario <= 15)
                                    <span class="badge bg-warning text-dark">{{ $producto->inventario }}</span>
                                @else
                                    {{ $producto->inventario }}
                                @endif
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.productos.show', $producto) }}" class="btn btn-sm btn-info text-white">Ver</a>
                                <a href="{{ route('admin.productos.edit', $producto) }}" class="btn btn-sm btn-warning">Editar</a>
                                <form method="POST" action="{{ route('admin.productos.destroy', $producto) }}" style="display:inline-block"
                                    onsubmit="return confirm('¿Seguro que deseas eliminar este producto?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No hay productos registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $productos->withQueryString()->links() }}
    </div>
@endsection
