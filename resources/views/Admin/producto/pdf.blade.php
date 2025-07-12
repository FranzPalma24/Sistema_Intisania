<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Productos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 10mm; /* Márgenes reducidos */
            color: #333;
        }
        .header {
            display: flex;
            justify-content: flex-end; /* Logo a la derecha */
            margin-bottom: 10px;
        }
        .logo img {
            max-width: 200px; /* Logo grande */
            height: auto;
        }
        h1 {
            text-align: left; /* Título alineado a la izquierda */
            color: #1a73e8;
            font-size: 20px;
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px; /* Fuente compacta */
        }
        th, td {
            border: 1px solid #999; /* Bordes de cuadrícula */
            padding: 6px; /* Espaciado reducido */
            text-align: left;
        }
        th {
            background-color: #e0e0e0; /* Encabezado gris */
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f5f5f5; /* Filas alternadas */
        }
        .footer {
            text-align: left; /* Pie de página a la izquierda */
            margin-top: 15px;
            font-size: 10px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">
            <img src="{{ public_path('image/logo_VidaSaludable.png') }}" alt="Logo">
        </div>
    </div>
    <h1>Reporte de Productos Activas</h1>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>ID_Categoria</th>
                <th>ID_Proveedor</th>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Codigo_barra</th>
                <th>Precio_Venta</th>
                <th>Precio_Compra</th>
                <th>Stock</th>
                <th>Stock_Minimo</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $index => $product)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $product->category_id }}</td>
                    <td>{{ $product->supplier_id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->codigo_barra }}</td>
                    <td>{{ $product->precio_venta }}</td>
                    <td>{{ $product->precio_compra }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->stock_minimo }}</td>
                    <td>Activo</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="footer">
        Generado el {{ now()->format('d/m/Y H:i') }} | Sistema de Gestión Vida Saludable
    </div>
</body>
</html>
