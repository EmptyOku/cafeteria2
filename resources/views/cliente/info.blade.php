{{-- filepath: f:\cafeteria2\resources\views\cliente\info.blade.php --}}
@extends('layouts.navigation')

@section('content')
<div class="container py-5">
    <div class="card shadow-sm border-0 mx-auto" style="max-width: 600px;">
        <div class="card-body">
            <h2 class="mb-3 text-center" style="color:#ff7043;">
                <i class="fas fa-info-circle"></i> Acerca de Super☕Caf
            </h2>
            <p class="lead text-center">
                Bienvenido a <strong>Super☕Caf</strong>, tu cafetería de confianza donde cada taza cuenta una historia.
            </p>
            <hr>
            <p>
                Fundada en 2024, Super☕Caf nació con la misión de ofrecer un espacio cálido y moderno para disfrutar del mejor café, deliciosos postres y una experiencia única. Nos apasiona la calidad, la atención personalizada y el compromiso con nuestros clientes.
            </p>
            <ul>
                <li><strong>Variedad:</strong> Contamos con un menú diverso de bebidas calientes, frías y snacks para todos los gustos.</li>
                <li><strong>Ambiente:</strong> Espacios cómodos, WiFi gratis y música relajante para estudiar, trabajar o compartir.</li>
                <li><strong>Reservas:</strong> Puedes reservar tu mesa desde nuestra plataforma y organizar tus reuniones sin preocupaciones.</li>
                <li><strong>Compromiso:</strong> Utilizamos ingredientes frescos y apoyamos a productores locales.</li>
            </ul>
            <p class="mt-3">
                ¡Gracias por ser parte de la familia Super☕Caf!<br>
                <span style="color:#ff7043;"><i class="fas fa-mug-hot"></i> Siempre hay un café esperando por ti.</span>
            </p>
            <div class="text-center mt-4">
                <a href="{{ url('/cliente/menu') }}" class="btn btn-naranja">
                    <i class="fas fa-utensils"></i> Ver Menú
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
