<?php
include 'connect.php';

if (!$connect) {
    die("Error en la conexión a la base de datos: " . mysqli_connect_error());
}

if (isset($_GET['id'])) {
    $vehicleId = (int)$_GET['id'];

    // Consulta para obtener un solo vehículo
    $query = "SELECT Modelo, Color, Año, TipoMotor, Potencia, Torque, RenComb, Peso, Aceite, Dimensiones, Precio, Imagen FROM vehiculos WHERE ID = $vehicleId";
    $result = $connect->query($query);

    if ($result && $result->num_rows > 0) {
        echo json_encode($result->fetch_assoc());
    } else {
        echo json_encode(null);
    }
} else {
    echo json_encode(null);
}
?>
