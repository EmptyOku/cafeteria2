<!-- filepath: resources/views/layouts/auth.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Iniciar Sesión - Cafetería</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            background: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 2px 16px rgba(0,0,0,0.08);
            background: #fff;
            min-width: 350px;
        }
        .login-header {
            background: #ff7043;
            color: #fff;
            border-radius: 1rem 1rem 0 0;
            font-family: 'Segoe Script', cursive;
            font-size: 1.5rem;
            text-align: center;
            padding: 1.2rem 1rem 1rem 1rem;
            letter-spacing: 1px;
        }
        .form-label {
            color: #e85d1f;
        }
        .btn-primary {
            background: #ff7043;
            border: none;
        }
        .btn-primary:hover {
            background: #e85d1f;
        }
    </style>
</head>
<body>
    <div class="login-card card">
        <div class="login-header">
            Cafetería
        </div>
        <div class="card-body">
            @yield('content')
        </div>
    </div>
</body>
</html>
