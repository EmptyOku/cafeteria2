<!-- filepath: f:\cafeteria2\resources\views\dashboard.blade.php -->
@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <!-- Panel superior de estadísticas -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3 mb-md-0">
            <div class="card shadow-sm border-0" style="background: #ff7043; color: #fff;">
                <div class="card-body">
                    <h6 class="card-title mb-1">Usuarios registrados</h6>
                    <h3 class="card-text mb-0">58</h3>
                    <small>Este mes</small>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3 mb-md-0">
            <div class="card shadow-sm border-0" style="background: #e85d1f; color: #fff;">
                <div class="card-body">
                    <h6 class="card-title mb-1">Productos</h6>
                    <h3 class="card-text mb-0">123</h3>
                    <small>En inventario</small>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3 mb-md-0">
            <div class="card shadow-sm border-0" style="background: #ffa270; color: #23272b;">
                <div class="card-body">
                    <h6 class="card-title mb-1">Ventas diarias</h6>
                    <h3 class="card-text mb-0">$1,250</h3>
                    <small>Hoy</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0" style="background: #fff3e0; color: #e85d1f;">
                <div class="card-body">
                    <h6 class="card-title mb-1">Ventas mensuales</h6>
                    <h3 class="card-text mb-0">$32,000</h3>
                    <small>Este mes</small>
                </div>
            </div>
        </div>
    </div>
   <!-- Overview -->
    <div class="card border-0 shadow-sm mb-4 overview-card">
        <div class="card-body">
            <h5 class="card-title" style="color: #e85d1f;">Overview</h5>
            <p class="card-text">Estadísticas, visualización de datos y resumen general del sistema.</p>
            <!-- Aquí puedes agregar gráficos o tablas en el futuro -->
        </div>
    </div>
</div>
@endsection
