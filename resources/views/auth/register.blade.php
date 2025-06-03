{{-- filepath: f:\cafeteria2\resources\views\auth\register.blade.php --}}
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrarse | Super☕Caf</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #ff7043 0%, #fff3e0 100%);
            min-height: 100vh;
        }
        .register-card {
            background: #fff;
            border-radius: 1.2rem;
            box-shadow: 0 4px 24px rgba(0,0,0,0.08);
            max-width: 420px;
            margin: 0 auto;
        }
        .register-logo {
            font-size: 3rem;
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
    </style>
</head>
<body>
    <div class="container d-flex flex-column justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="register-card p-4 p-md-5 shadow-lg text-center">
            <div class="register-logo mb-3">
                <i class="fas fa-user-plus"></i>
            </div>
            <h2 class="mb-3" style="color:#ff7043;">Crear cuenta</h2>
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-3 text-start">
                    <label for="name" class="form-label">Nombre completo</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                        name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 text-start">
                    <label for="email" class="form-label">Correo electrónico</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autocomplete="username">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 text-start">
                    <label for="password" class="form-label">Contraseña</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" required autocomplete="new-password">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 text-start">
                    <label for="password_confirmation" class="form-label">Confirmar contraseña</label>
                    <input id="password_confirmation" type="password" class="form-control"
                        name="password_confirmation" required autocomplete="new-password">
                </div>

                <div class="d-grid gap-2 mt-4">
                    <button type="submit" class="btn btn-naranja btn-lg">
                        <i class="fas fa-user-plus"></i> Registrarse
                    </button>
                </div>
                <div class="mt-3">
                    <a href="{{ route('login') }}" class="text-decoration-none text-muted">
                        <i class="fas fa-sign-in-alt"></i> ¿Ya tienes cuenta? Inicia sesión
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
