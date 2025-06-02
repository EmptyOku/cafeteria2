<!-- filepath: f:\cafeteria2\resources\views\layouts\admin.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cafetería</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
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
<div class="d-flex flex-column flex-md-row">
    <!-- Sidebar -->
    <nav class="sidebar d-flex flex-column">
        <div class="sidebar-header">
            Super☕Caf
        </div>
        <ul class="nav flex-column mt-2">
            @can('ver dashboard')
            <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link  py-2 px-2 rounded {{ request()->is('dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
            </li>
            @endcan

            @can('ver usuarios')
            <li class="nav-item">
                <a href="{{ route('admin.usuarios.index') }}" class="nav-link  py-2 px-2 rounded {{ request()->is('admin/usuarios*') ? 'active' : '' }}">
                    <i class="bi bi-people"></i> Usuarios
                </a>
            </li>
            @endcan

            @can('ver turnos')
            <li class="nav-item">
                <a href="{{ route('admin.turnos.index') }}" class="nav-link  py-2 px-2 rounded {{ request()->is('admin/turnos*') ? 'active' : '' }}">
                    <i class="bi bi-calendar2-week"></i> Turnos
                </a>
            </li>
            @endcan

            @can('ver mesas')
            <li class="nav-item">
                <a href="{{ route('admin.mesas.index') }}" class="nav-link  py-2 px-2 rounded {{ request()->is('admin/mesas*') ? 'active' : '' }}">
                    <i class="bi bi-grid-3x3-gap"></i> Mesas
                </a>
            </li>
            @endcan

            @can('ver pedidos')
            <li class="nav-item">
                <a href="{{ route('admin.pedidos.index') }}" class="nav-link  py-2 px-2 rounded {{ request()->is('admin/pedidos*') ? 'active' : '' }}">
                    <i class="bi bi-bag"></i> Pedidos
                </a>
            </li>
            @endcan

            @can('ver items de pedido')
            <li class="nav-item">
                <a href="#" class="nav-link  py-2 px-2 rounded">
                    <i class="bi bi-list-ul"></i> Ítems de pedido
                </a>
            </li>
            @endcan

            @can('ver productos')
            <li class="nav-item">
                <a href="{{ route('admin.productos.index') }}" class="nav-link  py-2 px-2 rounded {{ request()->is('admin/productos*') ? 'active' : '' }}">
                    <i class="bi bi-cup-straw"></i> Productos
                </a>
            </li>
            @endcan

            @can('ver inventario')
            <li class="nav-item">
                <a href="{{ route('admin.inventarios.index') }}" class="nav-link  py-2 px-2 rounded  {{ request()->is('admin/inventarios*') ? 'active' : '' }}">
                    <i class="bi bi-archive"></i> Inventario
                </a>
            </li>
            @endcan

            @can('ver categorias')
            <li class="nav-item">
                <a href="{{ route('admin.categorias.index') }}" class="nav-link py-2 px-2 rounded {{ request()->is('admin/categorias*') ? 'active' : '' }}">
                    <i class="bi bi-tags"></i> Categorías
                </a>
            </li>
            @endcan

            @can('ver proveedores')
            <li class="nav-item">
                <a href="{{ route('admin.proveedores.index') }}" class="nav-link  py-2 px-2 rounded {{ request()->is('admin/proveedores*') ? 'active' : '' }}">
                    <i class="bi bi-truck"></i> Proveedores
                </a>
            </li>
            @endcan

            @can('ver gastos')
            <li class="nav-item">
                <a href="#" class="nav-link  py-2 px-2 rounded">
                    <i class="bi bi-cash-stack"></i> Gastos
                </a>
            </li>
            @endcan

            @can('ver reservas')
            <li class="nav-item">
                <a href="{{ route('admin.reservas.index') }}" class="nav-link  py-2 px-2 rounded {{ request()->is('admin/reservas*') ? 'active' : '' }}">
                    <i class="bi bi-calendar-check"></i> Reservas
                </a>
            </li>
            @endcan

            @can('ver recetas')
            <li class="nav-item">
                <a href="{{ route('admin.recetas.index') }}" class="nav-link  py-2 px-2 rounded {{ request()->is('admin/recetas*') ? 'active' : '' }}">
                    <i class="bi bi-journal-bookmark"></i> Recetas
                </a>
            </li>
            @endcan
        </ul>
        <div class="sidebar-footer mt-auto">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline-danger w-100 mb-2">
                    <i class="bi bi-box-arrow-right"></i> Cerrar sesión
                </button>
            </form>
            <button class="btn btn-outline-secondary w-100" id="toggleDark">
                <i class="bi bi-moon"></i> Modo oscuro
            </button>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow-1 p-4">
        @yield('content')
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>

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
</body>
</html>
