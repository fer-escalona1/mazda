<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: loginA.php");
    exit;
}

include 'connect.php';

$adminClave = $_SESSION["Admin"];
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
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Agencia Automotriz</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#catalogContainer">Catálogo</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a href="/mazda/index.php" class="btn btn-danger">Cerrar Sesión</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h3>Bienvenido, <?php echo $nombreadmin; ?>.</h3>
    </div>

    <div class="container mt-4" id="catalogContainer">
        <h1>Catálogo de Vehículos</h1>
        <div class="row">
            <?php
            $query = "SELECT * FROM vehiculos";
            $result = $connect->query($query);

            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="' . $row['Imagen'] . '" class="card-img-top" alt="' . $row['Modelo'] . '">
                            <div class="card-body">
                                <h5 class="card-title">' . $row['Modelo'] . '</h5>
                                <p class="card-text">Precio: $' . number_format($row['precio'], 2) . '</p>
                                <button class="btn btn-primary" onclick="showVehicleDetails(' . $row['ID'] . ')">Editar</button>
                            </div>
                        </div>
                    </div>';
                }
            } else {
                echo '<p>No hay vehículos disponibles en este momento.</p>';
            }
            ?>
        </div>
    </div>

    <!-- Modal para editar -->
    <div class="modal" id="carModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Vehículo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editVehicleForm">
                        <input type="hidden" name="id" id="vehicleId">
                        <div class="mb-3">
                            <label for="modelo" class="form-label">Modelo</label>
                            <input type="text" class="form-control" name="modelo" id="modelo">
                        </div>
                        <div class="mb-3">
                            <label for="color" class="form-label">Color</label>
                            <input type="text" class="form-control" name="color" id="color">
                        </div>
                        <div class="mb-3">
                            <label for="anio" class="form-label">Año</label>
                            <input type="number" class="form-control" name="anio" id="anio">
                        </div>
                        <div class="mb-3">
                            <label for="precio" class="form-label">Precio</label>
                            <input type="number" class="form-control" step="0.01" name="precio" id="precio">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="saveChanges()">Guardar Cambios</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showVehicleDetails(vehicleId) {
            fetch('getVehiclesDetails.php?id=' + vehicleId)
                .then(response => response.json())
                .then(data => {
                    if (data) {
                        document.getElementById('vehicleId').value = data.ID;
                        document.getElementById('modelo').value = data.Modelo;
                        document.getElementById('color').value = data.Color;
                        document.getElementById('anio').value = data.Año;
                        document.getElementById('precio').value = data.precio;

                        const modal = new bootstrap.Modal(document.getElementById('carModal'));
                        modal.show();
                    } else {
                        alert('No se encontraron datos del vehículo.');
                    }
                })
                .catch(error => console.error('Error al obtener los datos del vehículo:', error));
        }

        function saveChanges() {
            const form = document.getElementById('editVehicleForm');
            const formData = new FormData(form);

            fetch('updateVehicle.php', {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        location.reload();
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => console.error('Error al actualizar el vehículo:', error));
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
