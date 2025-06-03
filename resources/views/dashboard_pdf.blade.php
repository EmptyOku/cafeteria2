{{-- filepath: resources/views/dashboard_pdf.blade.php --}}
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte Dashboard</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        h1 { color: #ff7043; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px;}
        th, td { border: 1px solid #ccc; padding: 8px; }
        th { background: #ff7043; color: #fff; }
    </style>
</head>
<body>
    <h1>Reporte Dashboard</h1>
    <p><strong>Usuarios registrados este mes:</strong> {{ $usuariosMes }}</p>
    <p><strong>Productos activos en inventario:</strong> {{ $productosInventario }}</p>
    <p><strong>Ventas hoy:</strong> ${{ number_format($ventasHoy, 2) }}</p>
    <p><strong>Ventas este mes:</strong> ${{ number_format($ventasMes, 2) }}</p>
    <h3>Productos con inventario bajo</h3>
    <ul>
        @foreach($productosBajos as $producto)
            <li>{{ $producto->nombre }} (Inventario: {{ $producto->inventario }})</li>
        @endforeach
    </ul>
    <h3>Inventarios bajos</h3>
    <ul>
        @foreach($inventariosBajos as $inv)
            <li>{{ $inv->producto->nombre ?? 'N/A' }} (Cantidad: {{ $inv->cantidad }})</li>
        @endforeach
    </ul>
    <h3>Ventas esta semana</h3>
    <table>
        <tr>
            <th>Fecha</th>
            <th>Total</th>
        </tr>
        @foreach($ventasSemana as $fecha => $total)
            <tr>
                <td>{{ $fecha }}</td>
                <td>${{ number_format($total, 2) }}</td>
            </tr>
        @endforeach
    </table>
    <h3>Gastos esta semana</h3>
    <table>
        <tr>
            <th>Fecha</th>
            <th>Total</th>
        </tr>
        @foreach($gastosSemana as $fecha => $total)
            <tr>
                <td>{{ $fecha }}</td>
                <td>${{ number_format($total, 2) }}</td>
            </tr>
        @endforeach
    </table>
</body>
</html>
