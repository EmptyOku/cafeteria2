@extends('layouts.admin')

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0" style="color: #e85d1f;">Categorías</h1>
        <a href="{{ route('admin.categorias.create') }}" class="btn btn-naranja">
            <i class="bi bi-plus-circle"></i> Nueva Categoría
        </a>
    </div>

    <div class="card shadow-sm categorias-card">
        <div class="card-body p-0">
            <table class="table categorias-table mb-0 ">
                <thead class="categorias-thead">
                    <tr>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Estado</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categorias as $categoria)
                        <tr class="{{ $loop->even ? 'fila-naranja-clara' : 'fila-blanca' }}">
                            <td>{{ $categoria->nombre }}</td>
                            <td>{{ $categoria->descripcion ?? '-' }}</td>
                            <td>
                                @if(empty($categoria->deleted_at))
                                    <span class="badge bg-success">Activo</span>
                                @else
                                    <span class="badge bg-secondary">Eliminado</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.categorias.show', $categoria) }}" class="btn btn-sm btn-info text-white">Ver</a>
                                <a href="{{ route('admin.categorias.edit', $categoria) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i> Editar</a>
                                <form method="POST" action="{{ route('admin.categorias.destroy', $categoria) }}" style="display:inline-block" onsubmit="return confirm('¿Seguro que deseas eliminar esta categoría?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i> Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">No hay categorías registradas.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $categorias->links() }}
    </div>
@endsection
