{{-- filepath: f:\cafeteria2\resources\views\cliente\menu.blade.php --}}
@extends('layouts.navigation')

@section('content')
<style>
    .menu-card-img {
        width: 100%;
        height: 180px;
        object-fit: cover;
        border-top-left-radius: .5rem;
        border-top-right-radius: .5rem;
        background: #f8f9fa;
    }
    .menu-card {
        min-height: 370px;
        max-width: 320px;
        margin-left: auto;
        margin-right: auto;
    }
    .menu-card .card-body {
        padding-bottom: 1rem;
    }
</style>
<div class="container py-4">
    <h2 class="mb-4 text-center"><i class="fas fa-utensils"></i> Menú de Productos</h2>
    <div class="row g-3">
        @forelse($productos as $producto)
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card h-100 shadow-sm menu-card">
                    @if($producto->imagen)
                        <img src="{{ $producto->imagen }}" class="menu-card-img" alt="{{ $producto->nombre }}">
                    @else
                        <img src="https://via.placeholder.com/300x180?text=Sin+Imagen" class="menu-card-img" alt="Sin imagen">
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title mb-1">{{ $producto->nombre }}</h5>
                        <p class="card-text mb-1 small">{{ $producto->descripcion }}</p>
                        <span class="badge bg-secondary mb-2">{{ $producto->categoria->nombre ?? 'Sin categoría' }}</span>
                        <div class="mt-auto d-flex flex-column align-items-start">
                            <span class="fw-bold text-success fs-6 mb-1">${{ number_format($producto->precio, 2) }}</span>
                            <span class="badge bg-info">Stock: {{ $producto->inventario }}</span>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-warning text-center">
                    No hay productos disponibles en este momento.
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection
