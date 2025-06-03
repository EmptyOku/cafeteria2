{{-- filepath: f:\cafeteria2\resources\views\dashboard.blade.php --}}
@extends('layouts.admin')
@can('ver dashboard')
@section('content')
<div class="container-fluid">
    <!-- Panel superior de estadísticas -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3 mb-md-0">
            <div class="card shadow-sm border-0" style="background: #ff7043; color: #fff;">
                <div class="card-body">
                    <h6 class="card-title mb-1">Usuarios registrados</h6>
                    <h3 class="card-text mb-0">{{ $usuariosMes }}</h3>
                    <small>Este mes</small>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3 mb-md-0">
            <div class="card shadow-sm border-0" style="background: #e85d1f; color: #fff;">
                <div class="card-body">
                    <h6 class="card-title mb-1">Productos activos</h6>
                    <h3 class="card-text mb-0">{{ $productosInventario }}</h3>
                    <small>En inventario</small>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3 mb-md-0">
            <div class="card shadow-sm border-0" style="background: #ffa270; color: #23272b;">
                <div class="card-body">
                    <h6 class="card-title mb-1">Ventas diarias</h6>
                    <h3 class="card-text mb-0">${{ number_format($ventasHoy, 0) }}</h3>
                    <small>Hoy</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0" style="background: #fff3e0; color: #e85d1f;">
                <div class="card-body">
                    <h6 class="card-title mb-1">Ventas mensuales</h6>
                    <h3 class="card-text mb-0">${{ number_format($ventasMes, 0) }}</h3>
                    <small>Este mes</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Alertas de productos por agotarse -->
    @if($productosBajos->count())
        <div class="alert alert-warning">
            <strong>¡Atención!</strong> Hay productos por agotarse:
            <ul class="mb-0">
                @foreach($productosBajos as $prod)
                    <li>{{ $prod->nombre }} (Stock: {{ $prod->inventario }})</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Alertas de inventario por agotarse -->
    @if($inventariosBajos->count())
        <div class="alert alert-danger">
            <strong>¡Alerta!</strong> Hay insumos de inventario por debajo del nivel de reorden:
            <ul class="mb-0">
                @foreach($inventariosBajos as $inv)
                    <li>{{ $inv->producto }} (Cantidad: {{ $inv->cantidad }}, Reorden: {{ $inv->nivel_reorden }})</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Gráficos -->
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title" style="color: #e85d1f;">Ventas de la semana</h5>
                    <canvas id="ventasSemanaChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title" style="color: #e85d1f;">Gastos de la semana</h5>
                    <canvas id="gastosSemanaChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    var ventasSemana = @json($ventasSemana);
    var gastosSemana = @json($gastosSemana);

    // Preparar datos para Chart.js
    const ventasLabels = Object.keys(ventasSemana);
    const ventasData = Object.values(ventasSemana);

    const gastosLabels = Object.keys(gastosSemana);
    const gastosData = Object.values(gastosSemana);

    // Gráfico de ventas
    new Chart(document.getElementById('ventasSemanaChart'), {
        type: 'bar',
        data: {
            labels: ventasLabels,
            datasets: [{
                label: 'Ventas',
                data: ventasData,
                backgroundColor: 'rgba(255, 99, 132, 0.5)'
            }]
        }
    });

    // Gráfico de gastos
    new Chart(document.getElementById('gastosSemanaChart'), {
        type: 'bar',
        data: {
            labels: gastosLabels,
            datasets: [{
                label: 'Gastos',
                data: gastosData,
                backgroundColor: 'rgba(54, 162, 235, 0.5)'
            }]
        }
    });
</script>
@endpush
@endcan
