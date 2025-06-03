{{-- filepath: f:\cafeteria2\resources\views\layouts\cliente.blade.php --}}
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cafetería - Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body {
            min-height: 100vh;
            background-color: #f8f9fa;
            transition: background 0.3s, color 0.3s;
        }
        .sidebar {
            min-width: 220px;
            max-width: 220px;
            background: #fff;
            border-right: 1px solid #eee;
            min-height: 100vh;
            padding: 0;
            transition: background 0.3s, color 0.3s;
        }
        .sidebar .sidebar-header {
            font-family: 'Segoe Script', cursive;
            font-size: 1.5rem;
            color: #e85d1f !important;
            padding: 1.2rem 1rem 1rem 1.2rem;
            border-bottom: 1px solid #eee;
            letter-spacing: 1px;
            transition: color 0.4s;
        }
        .navbar-brand {
            font-family: 'Segoe Script', cursive;
            font-size: 1.5rem;
            color: #fff !important;
        }
        .sidebar .nav-link {
            color: #444;
            font-size: 1.05rem;
            padding: 0.8rem 1.2rem;
            border-radius: 0 2rem 2rem 0;
            display: flex;
            align-items: center;
            gap: 0.7rem;
            transition: background 0.2s, color 0.2s;
        }
        .sidebar .nav-link.active, .sidebar .nav-link:hover {
            background: #ff7043;
            color: #fff;
        }
        .sidebar .nav-link .bi {
            font-size: 1.2rem;
        }
        .sidebar .sidebar-footer {
            margin-top: auto;
            padding: 1rem 1.2rem;
            border-top: 1px solid #eee;
        }
        .dark-mode {
            background: #23272b !important;
            color: #f8f9fa !important;
        }
        .dark-mode .sidebar {
            background: #23272b !important;
            border-right: 1px solid #444;
        }
        .dark-mode .sidebar .sidebar-header {
            color: #ff7043 !important;
            border-bottom: 1px solid #444;
        }
        .dark-mode .sidebar .nav-link {
            color: #ccc;
        }
        .dark-mode .sidebar .nav-link.active, .dark-mode .sidebar .nav-link:hover {
            background: #ff7043;
            color: #fff;
        }
        .dark-mode .sidebar .sidebar-footer {
            border-top: 1px solid #444;
        }
        * {
            transition: background-color 0.4s, color 0.4s, border-color 0.4s;
        }
        body {
            min-height: 100vh;
            background-color: #f8f9fa;
            transition: background 0.3s, color 0.3s;
        }
        .sidebar {
            min-width: 260px;
            max-width: 260px;
            background: #fff;
            border-right: 1px solid #eee;
            min-height: 100vh;
            padding: 0;
            transition: background 0.3s, color 0.3s;
        }
        .sidebar .sidebar-header {
            font-family: 'Segoe Script', cursive;
            font-size: 1.7rem;
            color: #e85d1f !important; /* Siempre naranja */
            padding: 1.5rem 1rem 1rem 1.5rem;
            border-bottom: 1px solid #eee;
            letter-spacing: 1px;
            transition: color 0.4s;
        }
        .sidebar .nav-link {
            color: #444;
            font-size: 1.05rem;
            padding: 0.9rem 1.5rem;
            border-radius: 0 2rem 2rem 0;
            display: flex;
            align-items: center;
            gap: 0.8rem;
            transition: background 0.2s, color 0.2s;
        }
        .sidebar .nav-link.active, .sidebar .nav-link:hover {
            background: #ff7043;
            color: #fff;
        }
        .sidebar .nav-link .bi {
            font-size: 1.2rem;
        }
        .sidebar .sidebar-footer {
            margin-top: auto;
            padding: 1rem 1.5rem;
            border-top: 1px solid #eee;
        }
        .dark-mode {
            background: #23272b !important;
            color: #f8f9fa !important;
        }
        .dark-mode .sidebar {
            background: #23272b !important;
            border-right: 1px solid #444;
        }
        .dark-mode .sidebar .sidebar-header {
            color: #ff7043 !important; /* O el naranja que prefieras para modo oscuro */
            border-bottom: 1px solid #444;
        }
        .dark-mode .sidebar .nav-link {
            color: #ccc;
        }
        .dark-mode .sidebar .nav-link.active, .dark-mode .sidebar .nav-link:hover {
            background: #ff7043;
            color: #fff;
        }
        .dark-mode .sidebar .sidebar-footer {
            border-top: 1px solid #444;
        }
            /* ...otros estilos... */
    .overview-card {
        background: #fff;
        transition: background 0.3s, color 0.3s;
    }
    .dark-mode .overview-card {
        background: #23272b !important;
        color: #f8f9fa;
    }
    .dark-mode .overview-card .card-title {
        color: #ff7043 !important;
    }
    .dark-mode .overview-card .card-text. {
        color: #ccc !important;
    }
    /* Botón naranja reutilizable */
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

    /* Tablas modo oscuro (solo para tablas de categorías, usando clases específicas) */
    .dark-mode .categorias-card {
        background: #23272b !important;
        color: #f8f9fa;
    }
    .dark-mode .categorias-table {
        background: #23272b !important;
        color: #f8f9fa;
    }
    .dark-mode .categorias-thead {
        background: #23272b !important;
        color: #ff7043;
    }
    .dark-mode .table-hover.categorias-table tbody tr:hover {
        background: #333 !important;
    }
    .dark-mode .badge.bg-success {
        background: #28a745 !important;
        color: #fff;
    }
    .dark-mode .badge.bg-secondary {
        background: #6c757d !important;
        color: #fff;
    }
    .dark-mode nav .pagination .page-link {
        background: #23272b;
        color: #ff7043;
        border-color: #444;
    }
    .dark-mode nav .pagination .page-item.active .page-link {
        background: #ff7043;
        color: #fff;
        border-color: #ff7043;
    }

    /* Tarjetas de estadísticas del dashboard */
    .stats-card {
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        margin-bottom: 1rem;
    }
    .dark-mode .stats-card {
        /* Si quieres que cambien en modo oscuro, agrega aquí los estilos */
        /* O déjalas igual si quieres que mantengan el color */
    }
    .fila-blanca {
    background: #fff !important;
    color: #212529 !important;
    transition: background 0.3s, color 0.3s;
}
.fila-naranja-clara {
    background: #ffe5d1 !important;
    color: #212529 !important;
    transition: background 0.3s, color 0.3s;
}

/* Modo oscuro para filas de la tabla de categorías */
.dark-mode .fila-blanca {
    background: #23272b !important;
    color: #f8f9fa !important;
}
.dark-mode .fila-naranja-clara {
    background: #3a2a23 !important;
    color: #f8f9fa !important;
}
.table.categorias-table > tbody > tr.fila-blanca {
    background-color: #fff !important;
    color: #212529 !important;
}
.table.categorias-table > tbody > tr.fila-naranja-clara {
    background-color: #ffe5d1 !important;
    color: #212529 !important;
}
.dark-mode .table.categorias-table > tbody > tr.fila-blanca {
    background-color: #23272b !important;
    color: #f8f9fa !important;
}
.dark-mode .table.categorias-table > tbody > tr.fila-naranja-clara {
    background-color: #3a2a23 !important;
    color: #f8f9fa !important;
}
    * {
        transition: background-color 0.4s, color 0.4s, border-color 0.4s;
    }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: #ff7043; z-index: 1040;">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="{{ route('cliente/home') }}">
                <i class="fas fa-mug-hot"></i> Super☕Caf
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCliente" aria-controls="navbarCliente" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCliente">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    @can('ver dashboard')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                            <i class="fas fa-tachometer-alt"></i> Dashboard
                        </a>
                    </li>
                    @endcan
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('cliente/menu*') ? 'active' : '' }}" href="{{ url('/cliente/menu') }}">
                            <i class="fas fa-utensils"></i> Menú
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('cliente/pedidos*') ? 'active' : '' }}" href="{{ url('/cliente/pedidos') }}">
                            <i class="fas fa-receipt"></i> Mis Pedidos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('cliente/reservas*') ? 'active' : '' }}" href="{{ url('/cliente/reservas') }}">
                            <i class="fas fa-chair"></i> Reservar Mesa
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('cliente/acerca*') ? 'active' : '' }}" href="{{ route('cliente/info') }}">
                            <i class="fas fa-info-circle"></i> Acerca de
                        </a>
                    </li>
                </ul>
                <form method="POST" action="{{ route('logout') }}" class="d-flex ms-lg-3">
                    @csrf
                    <button type="submit" class="btn btn-outline-light ">
                        <i class="fas fa-sign-out-alt"></i> Cerrar sesión
                    </button>
                </form>
                <button class="btn btn-outline-light ms-2" id="toggleDark" title="Modo oscuro">
                    <i class="fas fa-moon"></i>
                </button>
            </div>
        </div>
    </nav>
    {{-- Espacio para que el contenido no quede oculto bajo el navbar --}}
    <div style="height: 70px;"></div>

    {{-- CONTENIDO PRINCIPAL --}}
    <main class="container-fluid">
        @yield('content')
    </main>

    {{-- Modo oscuro --}}
    <style>
        body.dark-mode {
            background: #23272b !important;
            color: #f8f9fa !important;
        }
        body.dark-mode .navbar {
            background-color: #222 !important;
        }
        body.dark-mode .table {
            background: #23272b;
            color: #f8f9fa;
        }
        body.dark-mode .table thead {
            background: #ff7043 !important;
            color: #fff !important;
        }
        body.dark-mode .card, body.dark-mode .alert {
            background: #23272b;
            color: #f8f9fa;
        }
    </style>
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
