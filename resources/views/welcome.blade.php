{{-- filepath: f:\cafeteria2\resources\views\welcome.blade.php --}}
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bienvenido a Super☕Caf</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #ff7043 0%, #fff3e0 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', sans-serif;
        }
        .welcome-card {
            background: #fff;
            border-radius: 1.2rem;
            box-shadow: 0 4px 24px rgba(0,0,0,0.08);
            max-width: 420px;
            margin: 0 auto;
        }
        .welcome-logo {
            font-size: 3.5rem;
            color: #ff7043;
        }
        .btn-naranja {
            background: #ff7043;
            color: #fff;
            border: none;
            transition: background 0.2s;
        }
        .btn-naranja:hover, .btn-naranja:focus {
            background: #e85d1f;
            color: #fff;
        }
        .welcome-bg {
            background: url('https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=800&q=80') center/cover no-repeat;
            min-height: 100vh;
            opacity: 0.13;
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            z-index: 0;
        }
    </style>
</head>
<body>
    <div class="welcome-bg"></div>
    <div class="container d-flex flex-column justify-content-center align-items-center" style="min-height: 100vh; position: relative; z-index: 1;">
        <div class="welcome-card p-4 p-md-5 shadow-lg text-center">
            <div class="welcome-logo mb-3">
                <i class="fas fa-mug-hot"></i>
            </div>
            <h1 class="mb-2" style="color:#ff7043;">Bienvenido a Super☕Caf</h1>
            <p class="mb-4 text-muted">
                Tu cafetería de confianza donde cada taza cuenta una historia.<br>
                Disfruta del mejor café, postres y un ambiente único.
            </p>
            <div class="d-grid gap-2 mb-3">
                <a href="{{ route('login') }}" class="btn btn-naranja btn-lg">Iniciar sesión</a>
                <a href="{{ route('register') }}" class="btn btn-outline-secondary btn-lg">Registrarse</a>
            </div>
            <hr>
            <div class="text-center small text-muted">
                <i class="fas fa-info-circle"></i> ¿Nuevo aquí? Regístrate y vive la experiencia Super☕Caf.
            </div>
        </div>
    </div>
</body>
</html>
