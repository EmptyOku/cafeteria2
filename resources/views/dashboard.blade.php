<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard Cafetería</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      display: flex;
      min-height: 100vh;
    }
    .sidebar {
      width: 250px;
      background-color: #343a40;
      color: white;
    }
    .sidebar a {
      color: white;
      padding: 10px;
      display: block;
      text-decoration: none;
    }
    .sidebar a:hover {
      background-color: #495057;
    }
    .main-content {
      flex-grow: 1;
      padding: 20px;
    }
  </style>
</head>
<body>

  <!-- Sidebar -->
  <div class="sidebar d-flex flex-column p-3">
    <h4 class="text-center">Cafetería</h4>
    <a href="#">Dashboard</a>
    <a href="#">Usuarios</a>
    <a href="#">Turnos</a>
    <a href="#">Mesas</a>
    <a href="#">Pedidos</a>
    <a href="#">Ítems de pedido</a>
    <a href="#">Productos</a>
    <a href="#">Inventario</a>
    <a href="#">Categorías</a>
    <a href="#">Proveedores</a>
    <a href="#">Gastos</a>
    <a href="#">Reservas</a>
    <a href="#">Recetas</a>
  </div>

  <!-- Main Content -->
  <div class="main-content">
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
      <div class="container-fluid">
        <span class="navbar-brand mb-0 h1">Panel de Administración</span>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row g-3">
        <div class="col-md-4">
          <div class="card text-bg-primary">
            <div class="card-body">
              <h5 class="card-title">Total de Productos</h5>
              <p class="card-text fs-4">123</p>
            </div>
          </div>
        </div>
        <!-- Repite tarjetas para más métricas -->
      </div>
    </div>
  </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
