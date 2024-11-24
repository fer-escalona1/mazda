<?php
session_start(); // Iniciar la sesión

// Verificar si el vendedor está logueado
if (!isset($_SESSION["login"])) {
    header("Location: loginA.php"); // Redirigir al login si no está logueado
    exit;
}

// Obtener la clave del admin logueado
$adminClave = $_SESSION["Admin"];

// Conectar a la base de datos para obtener información del admin
include 'connect.php';
$consulta = "SELECT Nombre FROM aministradores WHERE ClaveAmin = '$adminClave'";
$resultado = $connect->query($consulta);
$admin = $resultado->fetch_assoc();
$nombreadmin = $admin['Nombre'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo - Administradores</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg rounded" aria-label="Eleventh navbar example">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample09" aria-controls="navbarsExample09" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsExample09">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <img src="logo.png" alt="Logo" width="70px">
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#c">Catálogo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Ventas</a>
                    </li>
                </ul>
                <!-- Botón de Cerrar Sesión -->
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a href="/mazda/index.php" class="btn btn-danger">Cerrar Sesión</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Bienvenida al Vendedor -->
    <div class="container mt-4">
        <h3>Bienvenido, <?php echo $nombreadmin; ?>.</h3>
    </div>

    <!-- CATALOGO -->
    <h1 id="c" class="title">Catálogo</h1>
    <div class="container">
        <div class="image-section" id="vehicle1">
            <h4>Mazda 2 Sedan</h4>
            <img src="/mazda/uploads/mazda2sedan.png" alt="Mazda 2 Sedan">
            <div class="buttons">
                <button class="edit-button" data-bs-toggle="modal" data-bs-target="#editModal">Editar</button>
            </div>
        </div>
        <div class="image-section" id="vehicle2">
            <h4>Mazda CX-3</h4>
            <img src="/mazda/uploads/mazdacx3.png" alt="Mazda CX-3">
            <div class="buttons">
                <button class="edit-button" data-bs-toggle="modal" data-bs-target="#editModal">Editar</button>
            </div>
        </div>
        <div class="image-section" id="vehicle3">
            <h4>Mazda CX-50</h4>
            <img src="/mazda/uploads/mazdacx50.png" alt="Mazda CX-50">
            <div class="buttons">
                <button class="edit-button" data-bs-toggle="modal" data-bs-target="#editModal">Editar</button>
            </div>
        </div>
        <div class="image-section" id="vehicle4">
            <h4>Mazda CX-90</h4>
            <img src="/mazda/uploads/mazdacx90.png" alt="Mazda CX-90">
            <div class="buttons">
                <button class="edit-button" data-bs-toggle="modal" data-bs-target="#editModal">Editar</button>
            </div>
        </div>
    </div>

    <!-- Modal para Editar -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Editar Vehículo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Aquí va el formulario de edición -->
                    <form action="editar_vehiculo.php" method="POST">
                        <div class="mb-3">
                            <label for="modelo" class="form-label">Modelo</label>
                            <input type="text" class="form-control" id="modelo" name="modelo" value="" required>
                        </div>
                        <div class="mb-3">
                            <label for="color" class="form-label">Color</label>
                            <input type="text" class="form-control" id="color" name="color" value="" required>
                        </div>
                        <div class="mb-3">
                            <label for="precio" class="form-label">Precio</label>
                            <input type="text" class="form-control" id="precio" name="precio" value="" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
