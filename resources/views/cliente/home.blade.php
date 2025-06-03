{{-- filepath: f:\cafeteria2\resources\views\cliente\home.blade.php --}}
@extends('layouts.navigation')
@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 ">
                <div class="card-body text-center sidebar-header ">
                    <h2 class="mb-3"><i class="bi bi-cup-hot"></i> ¡Bienvenido a Super☕Caf!</h2>
                    <p class="lead">Explora nuestro menú, realiza pedidos y consulta tu perfil desde la barra lateral.</p>
                    <hr>
                    <div class="row mt-4">
                        <div class="col-6 col-md-3 mb-3">
                            <a href="#" class="btn btn-naranja w-100">
                                <i class="bi bi-book"></i><br>Ver Menú
                            </a>
                        </div>
                        <div class="col-6 col-md-3 mb-3">
                            <a href="#" class="btn btn-outline-primary w-100">
                                <i class="bi bi-bag-check"></i><br>Mis Pedidos
                            </a>
                        </div>
                        <div class="col-6 col-md-3 mb-3">
                            <a href="#" class="btn btn-outline-secondary w-100">
                                <i class="bi bi-person"></i><br>Mi Perfil
                            </a>
                        </div>
                        <div class="col-6 col-md-3 mb-3">
                            <a href="#" class="btn btn-outline-info w-100">
                                <i class="bi bi-info-circle"></i><br>Acerca de
                            </a>
                        </div>
                    </div>
                    <p class="mt-4 text-muted">¿Necesitas ayuda? Contáctanos desde tu perfil.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
