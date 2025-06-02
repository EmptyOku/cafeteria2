@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0" style="color: #e85d1f;">Inventario</h1>
        <a href="{{ route('admin.inventarios.create') }}" class="btn btn-naranja">
            <i class="bi bi-plus-circle"></i> Nuevo Producto
        </a>
    </div>

    <form method="GET" action="{{ route('admin.inventarios.index') }}" class="row g-3 mb-4">
        <div class="col-md-4">
            <input type="text" name="buscar" class="form-control" placeholder="Buscar producto..." value="{{ request('buscar') }}">
        </div>
        <div class="col-md-4">
            <select name="proveedor_id" class="form-select">
                <option value="">Todos los proveedores</option>
                @foreach($proveedores as $proveedor)
                    <option value="{{ $proveedor->id }}" {{ request('proveedor_id') == $proveedor->id ? 'selected' : '' }}>
                        {{ $proveedor->nombre }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-naranja w-100">Filtrar</button>
        </div>
        <div class="col-md-2">
            <a href="{{ route('admin.inventarios.index') }}" class="btn btn-secondary w-100">Limpiar</a>
        </div>
    </form>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm categorias-card">
        <div class="card-body p-0">
            <table class="table categorias-table mb-0">
                <thead class="categorias-thead">
                    <tr>
                        <th>Producto</th>
                        <th>Descripción</th>
                        <th>Cantidad</th>
                        <th>Unidad</th>
                        <th>Proveedor</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($inventarios as $inventario)
                        <tr class="{{ $loop->even ? 'fila-naranja-clara' : 'fila-blanca' }}">
                            <td>{{ $inventario->producto }}</td>
                            <td>{{ $inventario->descripcion ?? '-' }}</td>
                            <td>{{ $inventario->cantidad }}</td>
                            <td>{{ $inventario->unidad }}</td>
                            <td>{{ $inventario->proveedor->nombre ?? '-' }}</td>
                            <td class="text-end">
                                <a href="{{ route('admin.inventarios.show', $inventario) }}" class="btn btn-sm btn-info text-white">Ver</a>
                                <a href="{{ route('admin.inventarios.edit', $inventario) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i> Editar</a>
                                <form method="POST" action="{{ route('admin.inventarios.destroy', $inventario) }}" style="display:inline-block" onsubmit="return confirm('¿Seguro que deseas eliminar este producto?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i> Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No hay productos en el inventario.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $inventarios->withQueryString()->links() }}
    </div>
@endsection
