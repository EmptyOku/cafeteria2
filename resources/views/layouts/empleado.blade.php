{{-- filepath: f:\cafeteria2\resources\views\layouts\empleado.blade.php --}}
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cafetería - Empleado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body {
            min-height: 100vh;
            background-color: #f8f9fa;
            transition: background 0.3s, color 0.3s;
        }
        .navbar-brand {
            font-family: 'Segoe Script', cursive;
            font-size: 1.5rem;
            color: #fff !important;
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
        body.dark-mode {
            background: #23272b !important;
            color: #f8f9fa !important;
        }
        body.dark-mode .navbar {
            background-color: #222 !important;
        }
        body.dark-mode .table,
        body.dark-mode .card,
        body.dark-mode .alert {
            background: #23272b;
            color: #f8f9fa;
        }
        body.dark-mode .table thead {
            background: #ff7043 !important;
            color: #fff !important;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: #ff7043; z-index: 1040;">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="#">
                <i class="fas fa-mug-hot"></i> Super☕Caf
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarEmpleado" aria-controls="navbarEmpleado" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarEmpleado">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    @can('ver dashboard')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                            <i class="fas fa-tachometer-alt"></i> Dashboard
                        </a>
                    </li>
                    @endcan
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('empleado/mesas*') ? 'active' : '' }}" href="{{ url('/empleado/mesas') }}">
                            <i class="fas fa-chair"></i> Ver Mesas
                        </a>
                    </li>
                </ul>
                <form method="POST" action="{{ route('logout') }}" class="d-flex ms-lg-3">
                    @csrf
                    <button type="submit" class="btn btn-outline-light">
                        <i class="fas fa-sign-out-alt"></i> Cerrar sesión
                    </button>
                </form>
                <button class="btn btn-outline-light ms-2" id="toggleDark" title="Modo oscuro">
                    <i class="fas fa-moon"></i>
                </button>
            </div>
        </div>
    </nav>
    <div style="height: 70px;"></div>
    <main class="container-fluid">
        @yield('content')
    </main>
    <script>
        // Modo oscuro persistente
        if (localStorage.getItem('dark-mode') === 'enabled') {
            document.body.classList.add('dark-mode');
        }
        document.getElementById('toggleDark').addEventListener('click', function() {
            document.body.classList.toggle('dark-mode');
            if (document.body.classList.contains('dark-mode')) {
                localStorage.setItem('dark-mode', 'enabled');
            } else {
                localStorage.setItem('dark-mode', 'disabled');
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
