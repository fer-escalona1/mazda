<?php
// Incluir el archivo de conexión
include 'connect.php';

// Verificar si la conexión se estableció correctamente
if (!$connect) {
    die("Error en la conexión a la base de datos: " . mysqli_connect_error());
}

// Consulta para obtener los vehículos
$query = "SELECT Modelo, Color, Año, TipoMotor, Potencia, Torque, RenComb, Peso, Aceite, Dimensiones, Precio, ID, Imagen FROM vehiculos";

// Ejecutar la consulta y manejar errores
$result = $connect->query($query);

if (!$result) {
    // Mostrar el error SQL para depuración
    die("Error en la consulta SQL: " . $connect->error);
}

// Procesar los datos si la consulta fue exitosa
$vehicles = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $vehicles[] = $row;
    }
}

// Devolver los datos como JSON
header('Content-Type: application/json');
echo json_encode($vehicles);
?>
