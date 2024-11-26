<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: loginA.php");
    exit;
}

include 'connect.php';

// Consulta para obtener todas las ventas ordenadas por sucursal
$query = "SELECT Sucursal, ID, vendedor_nombre, Modelo, precio, Color, Fecha_venta FROM Ventas ORDER BY Sucursal";
$result = $connect->query($query);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ventas Registradas</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .table-header-custom {
            background-color: #910A2D !important;
            color: white !important;
        }
        .sucursal-header {
            background-color: #910A2D;
            color: white;
            padding: 10px;
            border: 1px solid #ddd;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #000000;">
        <div class="container-fluid">
        <<img src="logo.png" alt="Logo" width="70px">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="/mazda/indexAdmin.php">Catálogo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/mazda/ventas.php">Ventas</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a href="logout.php" class="btn btn-danger">Cerrar Sesión</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h1>Ventas Registradas</h1>
        <?php
        if ($result && $result->num_rows > 0) {
            $currentSucursal = null;

            while ($row = $result->fetch_assoc()) {
                // Si cambia la sucursal, muestra un encabezado nuevo
                if ($currentSucursal !== $row['Sucursal']) {
                    if ($currentSucursal !== null) {
                        echo '</tbody></table>'; // Cierra la tabla anterior
                    }

                    $currentSucursal = $row['Sucursal'];
                    echo "<div class='sucursal-header'><h3>Sucursal: {$currentSucursal}</h3></div>";
                    echo '
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead class="table-header-custom">
                                <tr>
                                    <th>ID</th>
                                    <th>Vendedor</th>
                                    <th>Modelo</th>
                                    <th>Precio</th>
                                    <th>Color</th>
                                    <th>Fecha de Venta</th>
                                </tr>
                            </thead>
                            <tbody>
                    ';
                }

                // Mostrar las filas dentro de la tabla de la sucursal
                echo "<tr>
                    <td>{$row['ID']}</td>
                    <td>{$row['vendedor_nombre']}</td>
                    <td>{$row['Modelo']}</td>
                    <td>$" . number_format($row['precio'], 2) . "</td>
                    <td>{$row['Color']}</td>
                    <td>{$row['Fecha_venta']}</td>
                </tr>";
            }

            // Cierra la última tabla
            echo '</tbody></table>';
        } else {
            echo "<p>No hay ventas registradas.</p>";
        }
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
