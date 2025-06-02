@extends('layouts.admin')

@section('content')
@if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0" style="color: #e85d1f;">Recetas</h1>
        <a href="{{ route('admin.recetas.create') }}" class="btn btn-naranja">
            <i class="bi bi-plus-circle"></i> Nueva Receta
        </a>
    </div>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Producto</th>
                <th>Insumo</th>
                <th>Cantidad</th>
                <th>Instrucciones</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($recetas as $receta)
                <tr>
                    <td>{{ $receta->id }}</td>
                    <td>{{ $receta->producto->nombre ?? '-' }}</td>
                    <td>{{ $receta->insumo->producto ?? '-' }}</td>
                    <td>{{ $receta->cantidad }}</td>
                    <td>{{ Str::limit($receta->instrucciones, 50) }}</td>
                    <td>
                        <a href="{{ route('admin.recetas.show', $receta) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('admin.recetas.edit', $receta) }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i> Editar</a>
                        <form action="{{ route('recetas.destroy', $receta) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que deseas eliminar esta receta?')"><i class="bi bi-trash"></i> Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">No hay recetas registradas.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{ $recetas->links() }}
</div>
@endsection
