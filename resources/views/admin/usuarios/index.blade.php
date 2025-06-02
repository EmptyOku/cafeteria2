@extends('layouts.admin')

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0" style="color: #e85d1f;">Usuarios</h1>
        <a href="{{ route('admin.usuarios.create') }}" class="btn btn-naranja">
            <i class="bi bi-plus-circle"></i> Nuevo Usuario
        </a>
    </div>

    <div class="card shadow-sm categorias-card">
        <div class="card-body p-0">
            <table class="table categorias-table mb-0 ">
                <thead class="categorias-thead">
                    <tr>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Rol</th>
                        <th>Teléfono</th>
                        <th>Dirección</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($usuarios as $usuario)
                        <tr class="{{ $loop->even ? 'fila-naranja-clara' : 'fila-blanca' }}">
                            <td>{{ $usuario->nombre }}</td>
                            <td>{{ $usuario->correo }}</td>
                            <td>{{ ucfirst($usuario->rol) }}</td>
                            <td>{{ $usuario->telefono ?? '-' }}</td>
                            <td>{{ $usuario->direccion ?? '-' }}</td>
                            <td class="text-end">
                                <a href="{{ route('admin.usuarios.show', $usuario) }}" class="btn btn-sm btn-info text-white">Ver</a>
                                <a href="{{ route('admin.usuarios.edit', $usuario) }}" class="btn btn-sm btn-warning">Editar</a>
                                <form method="POST" action="{{ route('admin.usuarios.destroy', $usuario) }}" style="display:inline-block" onsubmit="return confirm('¿Seguro que deseas eliminar este usuario?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No hay usuarios registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $usuarios->links() }}
    </div>
@endsection
