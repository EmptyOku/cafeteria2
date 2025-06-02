@extends('layouts.admin')

@section('content')
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="mb-0" style="color: #e85d1f;">Proveedores</h1>
    <a href="{{ route('admin.proveedores.create') }}" class="btn btn-naranja">
        <i class="bi bi-plus-circle"></i> Nuevo Proveedor
    </a>
</div>

<div class="card shadow-sm categorias-card">
    <div class="card-body p-0">
        <table class="table categorias-table mb-0">
            <thead class="categorias-thead">
                <tr>
                    <th>Nombre</th>
                    <th>Contacto</th>
                    <th>Teléfono</th>
                    <th>Correo</th>
                    <th>Dirección</th>
                    <th class="text-end">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($proveedores as $proveedor)
                    <tr class="{{ $loop->even ? 'fila-naranja-clara' : 'fila-blanca' }}">
                        <td>{{ $proveedor->nombre }}</td>
                        <td>{{ $proveedor->contacto ?? '-' }}</td>
                        <td>{{ $proveedor->telefono ?? '-' }}</td>
                        <td>{{ $proveedor->correo ?? '-' }}</td>
                        <td>{{ $proveedor->direccion ?? '-' }}</td>
                        <td class="text-end">
                            <a href="{{ route('admin.proveedores.show', $proveedor) }}" class="btn btn-sm btn-info text-white">Ver</a>
                            <a href="{{ route('admin.proveedores.edit', $proveedor) }}" class="btn btn-sm btn-warning">Editar</a>
                            <form method="POST" action="{{ route('admin.proveedores.destroy', $proveedor) }}" style="display:inline-block" onsubmit="return confirm('¿Seguro que deseas eliminar este proveedor?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No hay proveedores registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">
    {{ $proveedores->links() }}
</div>
@endsection
