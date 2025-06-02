{{-- filepath: f:\cafeteria2\resources\views\admin\gastos\index.blade.php --}}
@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0" style="color: #e85d1f;">Gastos</h1>
        <a href="{{ route('admin.gastos.create') }}" class="btn btn-naranja">
            <i class="bi bi-plus"></i> Nuevo Gasto
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
                            <th>Usuario</th>
                            <th>Monto</th>
                            <th>Categoría</th>
                            <th>Fecha</th>
                            <th>Inventario Relacionado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($gastos as $gasto)
                            <tr>
                                <td>{{ $gasto->id }}</td>
                                <td>{{ $gasto->usuario->nombre ?? 'Usuario #'.$gasto->usuario_id }}</td>
                                <td>${{ number_format($gasto->monto, 2) }}</td>
                                <td>{{ $gasto->categoria }}</td>
                                <td>{{ \Carbon\Carbon::parse($gasto->fecha)->format('d/m/Y') }}</td>
                                <td>
                                    @if($gasto->relacion_inventario)
                                        {{ $gasto->inventario->producto ?? 'Inventario #'.$gasto->relacion_inventario }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.gastos.show', $gasto->id) }}" class="btn btn-sm btn-info" title="Ver">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.gastos.edit', $gasto->id) }}" class="btn btn-sm btn-warning" title="Editar">
                                        <i class="bi bi-pencil"></i> Editar
                                    </a>
                                    <form action="{{ route('admin.gastos.destroy', $gasto->id) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('¿Seguro que deseas eliminar este gasto?');">
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
                                <td colspan="7" class="text-center">No hay gastos registrados.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-3">
        {{ $gastos->links() }}
    </div>
@endsection
